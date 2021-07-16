<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\BankAccountController;
use App\Models\AdministrativeTask;
use App\Models\BankAccount;
use App\Models\ClientBankAccount;
use App\Models\DocumentsAdministrative;
use App\Models\EmployeesBankAccount;
use App\Models\OwnerBankAccount;
use App\Models\PartnerBankAccount;
use App\Models\ProviderBankAccount;
use App\Models\RealEstateBankAccount;
use App\Models\RealtyAttachment;
use App\Models\RealtyMedia;
use App\Models\RouterS3;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Utils
{

    public static function buildReturnSuccessStatement($data)
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public static function buildReturnErrorStatement($exception)
    {
        return response()->json([
            'success' => false,
            'msg' => $exception
        ], 500);
    }

    public static function buildReturnCustomerSpFree(){
        return response()->json([
            'SP' => true,
            'success' => false,
            'msg' => 'Cliente de SP do plano Free não pode ser excluído!',
        ]);
    }

}
