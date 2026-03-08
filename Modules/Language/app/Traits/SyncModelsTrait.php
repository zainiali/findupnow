<?php

namespace Modules\Language\app\Traits;

use Illuminate\Support\Facades\Log;
use Modules\Language\app\Enums\SyncLanguageType;
use Modules\Language\app\Jobs\CreateNewTranslatedDataJob;
use Modules\Language\app\Jobs\DeleteTranslationDataJob;
use Modules\Language\app\Jobs\UpdateTranslationCodeJob;
use Modules\Language\app\Models\Language;

trait SyncModelsTrait
{
    use TranslateableModelsTrait;

    /**
     * @param  string  $type
     * @param  bool    $shouldQueue
     * @param  string  $code
     * @param  string  $oldCode
     * @return mixed
     */
    private function syncModels(string $type, bool $shouldQueue, string $code, ?string $oldCode = null)
    {
        $defaultCode = Language::first()->code;
        if ($type == SyncLanguageType::CREATE->value) {
            if ($shouldQueue) {
                return $this->createModelsFromQueue($defaultCode, $code);
            }

            return $this->createModels($defaultCode, $code);
        } elseif ($type == SyncLanguageType::UPDATE->value) {
            if ($shouldQueue) {
                return $this->updateModelsFromQueue($oldCode, $code);
            }

            return $this->updateModels($oldCode, $code);
        } elseif ($type == SyncLanguageType::DELETE->value) {
            if ($shouldQueue) {
                return $this->deleteModelsFromQueue($code);
            }

            return $this->deleteModels($code);
        }
    }

    /**
     * @param $defaultCode
     * @param $newCode
     */
    private function createModels($defaultCode, $newCode)
    {
        $models         = $this->getTranslatableModelsArray();
        $ignoredColumns = $this->getIgnoredColumnsArray();

        foreach ($models as $translateAbleModel) {
            $countCreatedModels = 0;
            $oldModels          = $translateAbleModel::where('lang_code', $defaultCode)->get();
            foreach ($oldModels as $oldModel) {
                if (!$translateAbleModel::where(['id' => $oldModel->id, 'lang_code' => $newCode])->exists()) {
                    $newModel            = new $translateAbleModel();
                    $newModel->lang_code = $newCode;
                    foreach ($oldModel->toArray() as $key => $value) {
                        if (!in_array($key, $ignoredColumns)) {
                            $newModel->$key = $value;
                        }
                    }
                    $newModel->save();
                    $countCreatedModels++;
                }
            }
            Log::info("Total { $countCreatedModels } new recordes has been saved into {$translateAbleModel} model for {$newCode} Language");
        }

        return true;
    }

    /**
     * @param $defaultCode
     * @param $newCode
     */
    private function createModelsFromQueue($defaultCode, $newCode)
    {
        $models = $this->getTranslatableModelsArray();

        foreach ($models as $translateableModel) {
            dispatch(new CreateNewTranslatedDataJob($defaultCode, $newCode, $translateableModel));
        }

        return true;
    }

    /**
     * @param $oldCode
     * @param $newCode
     */
    private function updateModels($oldCode, $newCode)
    {
        $models = $this->getTranslatableModelsArray();

        foreach ($models as $translateAbleModel) {
            $countCreatedModels = 0;
            $oldModels          = $translateAbleModel::where('lang_code', $oldCode)->get();
            foreach ($oldModels as $oldModel) {
                $oldModel->lang_code = $newCode;
                $oldModel->save();
                $countCreatedModels++;
            }
            Log::info("Total { $countCreatedModels } new recordes has been updated on {$translateAbleModel} model for {$newCode} Language");
        }

        return true;
    }

    /**
     * @param $oldCode
     * @param $newCode
     */
    private function updateModelsFromQueue($oldCode, $newCode)
    {
        $models = $this->getTranslatableModelsArray();

        foreach ($models as $translateableModel) {
            dispatch(new UpdateTranslationCodeJob($oldCode, $newCode, $translateableModel));
        }

        return true;
    }

    /**
     * @param $code
     */
    private function deleteModels($code)
    {
        $models = $this->getTranslatableModelsArray();

        foreach ($models as $translateAbleModel) {
            $deleteModels       = $translateAbleModel::where('lang_code', $code);
            $countCreatedModels = $deleteModels->count();
            $deleteModels->delete();
            Log::info("Total { $countCreatedModels } recordes has been deleted into {$translateAbleModel} model for {$code} Language");
        }

        return true;
    }

    /**
     * @param $code
     */
    private function deleteModelsFromQueue($code)
    {
        $models = $this->getTranslatableModelsArray();

        foreach ($models as $translateableModel) {
            dispatch(new DeleteTranslationDataJob($code, $translateableModel));
        }

        return true;
    }
}
