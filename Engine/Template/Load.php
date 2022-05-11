<?php


namespace Engine\Template;


class Load
{
    const MASK_MODEL_ENTITY = '\%s\%s\Model';
    const MASK_MODEL_REPOSITORY = '\%s\%s\Model\%sRepository';

    public function model($modelName, $modelDir = false)
    {
        global $di;

        $modelName = ucfirst($modelName);
        $model = new \stdClass();
        $modelDir = $modelDir ? $modelDir : $modelName;

        $namespaceEntity = sprintf(
            self::MASK_MODEL_ENTITY,
            ENV, $modelDir, $modelName
        );

        $namespaceRepository = sprintf(
            self::MASK_MODEL_REPOSITORY,
            ENV, $modelDir, $modelName
        );

        $model->entity = $namespaceEntity;
        $model->repository = new $namespaceRepository($di);

        return $model;
    }
}