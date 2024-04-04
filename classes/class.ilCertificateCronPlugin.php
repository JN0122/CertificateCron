<?php

require_once __DIR__ . "/../vendor/autoload.php";

use srag\DIC\Certificate\DICTrait;
use srag\Plugins\Certificate\Cron\CertificateJob;

/**
 * Class ilCertificateCronPlugin
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ilCertificateCronPlugin extends ilCronHookPlugin
{

    use DICTrait;

    const PLUGIN_CLASS_NAME = ilCertificatePlugin::class;
    const PLUGIN_ID = "certcron";
    const PLUGIN_NAME = "CertificateCron";
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * ilCertificateCronPlugin constructor
     */
    public function __construct(ilDBInterface $db,ilComponentRepositoryWrite $component_repository,string $id)
    {
        parent::__construct($db, $component_repository, $id);
    }


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * @inheritDoc
     */
    public function getPluginName() : string
    {
        return self::PLUGIN_NAME;
    }


    /**
     * @inheritDoc
     */
    public function getCronJobInstance(/*string*/ $a_job_id):ilCronJob/*: ?ilCronJob*/
    {
        switch ($a_job_id) {
            case CertificateJob::CRON_JOB_ID:
                return new CertificateJob();

            default:
                return null;
        }
    }


    /**
     * @inheritDoc
     */
    public function getCronJobInstances() : array
    {
        return [
            new CertificateJob()
        ];
    }
}
