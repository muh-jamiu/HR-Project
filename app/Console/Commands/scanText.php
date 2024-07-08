<?php
// app/Console/Commands/ExtractTranslations.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class ExtractTranslations extends Command
{
    protected $signature = 'translations:extract';
    protected $description = 'Extract translatable strings from views';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $finder = new Finder();
        $finder->files()->in(resource_path('views'))->name('*.php');

        $translations = [];

        foreach ($finder as $file) {
            $contents = $file->getContents();
            preg_match_all('/__\(\'([^\']+)\'\)/', $contents, $matches);
            foreach ($matches[1] as $match) {
                $translations[$match] = $match;
            }
        }

        file_put_contents(resource_path('lang/en/messages.php'), '<?php return ' . var_export($translations, true) . ';');

        $this->info('Translations extracted successfully.');
    }
}
