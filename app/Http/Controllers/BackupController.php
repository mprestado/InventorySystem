<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogger;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class BackupController extends Controller
{
    protected function backupPath(): string
    {
        $path = storage_path('app/backups');
        File::ensureDirectoryExists($path);

        return $path;
    }

    public function index()
    {
        $files = collect(File::files($this->backupPath()))
            ->sortByDesc(fn ($f) => $f->getMTime())
            ->map(fn ($f) => [
                'name' => $f->getFilename(),
                'size' => round($f->getSize() / 1024, 1),
                'date' => date('Y-m-d H:i', $f->getMTime()),
            ])->values();

        return view('backups.index', compact('files'));
    }

    public function create()
    {
        $db = config('database.connections.mysql');
        $filename = 'backup-'.now()->format('Ymd_His').'.sql';
        $target = $this->backupPath().DIRECTORY_SEPARATOR.$filename;
        $dump = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';

        if (! file_exists($dump)) {
            return back()->with('error', 'mysqldump not found at '.$dump);
        }

        $args = [$dump, '-h', $db['host'], '-P', (string) $db['port'], '-u', $db['username']];
        if (! empty($db['password'])) {
            $args[] = '-p'.$db['password'];
        }
        $args[] = $db['database'];

        $process = new Process($args);
        $process->setTimeout(300);
        $process->run();

        if (! $process->isSuccessful()) {
            return back()->with('error', 'Backup failed: '.$process->getErrorOutput());
        }

        File::put($target, $process->getOutput());
        ActivityLogger::log('backup', "Created database backup: {$filename}");

        return back()->with('success', "Backup created: {$filename}");
    }

    public function download(string $file)
    {
        $path = $this->backupPath().DIRECTORY_SEPARATOR.basename($file);
        abort_unless(File::exists($path), 404);

        return response()->download($path);
    }

    public function destroy(string $file)
    {
        $path = $this->backupPath().DIRECTORY_SEPARATOR.basename($file);
        if (File::exists($path)) {
            File::delete($path);
            ActivityLogger::log('backup', "Deleted backup: {$file}");
        }

        return back()->with('success', 'Backup deleted.');
    }
}
