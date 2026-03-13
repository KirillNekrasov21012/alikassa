<?php

namespace App\Http\Controllers;

use App\Http\Requests\Wallet\DepositRequest;
use App\Http\Requests\Wallet\WithdrawRequest;
use App\Services\WalletService;
use App\Traits\Logs\Logs;
use Illuminate\Http\JsonResponse;

class WalletController extends Controller
{
    use Logs;
    public function __construct(
        private readonly WalletService $walletService,
    ) {}

    public function deposit(DepositRequest $request): JsonResponse
    {
        try {
            $data = $request->getData();
            $transaction = $this->walletService->deposit(amount: $data['amount'], hash: $data['hash']);
            $response = array_merge(['status' => true, 'message' => 'Зачисление выполнено успешно!'], compact('transaction'));
            $code = 200;
        } catch (\Exception $e) {
            $this->recordLogInfo('Ошибка при зачислении', $e);
            $response = ['status' => false, 'message' => $e->getMessage()];
            $code = $e->getCode() ?: 400;
        } catch (\Throwable $th) {
            $this->recordLogError('Ошибка при зачислении', $th);
            $response = ['status' => false, 'message' => 'Системная ошибка'];
            $code = $th->getCode() ?: 500;
        } finally {
            return response()->json($response, $code);
        }
    }

    public function withdraw(WithdrawRequest $request): JsonResponse
    {
        try {
            $data = $request->getData();
            $transaction = $this->walletService->withdraw(amount: $data['amount']);
            $response = array_merge(['status' => true, 'message' => 'Зачисление выполнено успешно!'], compact('transaction'));
            $code = 200;
        } catch (\Exception $e) {
            $this->recordLogInfo('Ошибка при зачислении', $e);
            $response = ['status' => false, 'message' => $e->getMessage()];
            $code = $e->getCode() ?: 400;
        } catch (\Throwable $th) {
            $this->recordLogError('Ошибка при зачислении', $th);
            $response = ['status' => false, 'message' => 'Системная ошибка'];
            $code = $th->getCode() ?: 500;
        } finally {
            return response()->json($response, $code);
        }
    }
}
