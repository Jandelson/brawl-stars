<?php

namespace App\Jobs;

use App\Enums\LanguageIAEnum;
use App\Helpers\TranslateWithIA;
use App\Models\Description;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TranslateTextJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $retryAfter = 60;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected string $text,
        protected int $object_id,
        protected string $languageIAEnum
    ) {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $descriptionText = TranslateWithIA::translate($this->text, $this->languageIAEnum);

            Log::info('translate: ' . $descriptionText);

            Description::updateOrCreate(
                ['object_id' => $this->object_id],
                [
                    'object_id' => $this->object_id,
                    'description_text' => $descriptionText,
                    ]
            );

            Log::info('insert id: ' . $this->object_id);
        } catch (Exception $error) {
            throw $error;
        }
    }
}
