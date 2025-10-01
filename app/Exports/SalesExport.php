<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function query()
    {
        $query = Sale::query()
            ->with(['client', 'vendor'])
            ->orderBy('created_at', 'desc');

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID Venda',
            'Referência',
            'ID Cliente',
            'Nome Cliente',
            'CPF Cliente',
            'ID Vendedor',
            'Nome Vendedor',
            'Valor Original (R$)',
            'Pts Ganhos',
            'Pts Usados',
            'Valor Final (R$)',
            'Data/Hora',
        ];
    }

    public function map($sale): array
    {
        return [
            $sale->id,
            $sale->reference_number ?? '',
            $sale->client_id,
            $sale->client?->name ?? 'N/A',
            $sale->client?->cpf ?? 'N/A',
            $sale->vendor_id ?? '',
            $sale->vendor?->name ?? 'N/A',
            number_format($sale->amount, 2, ',', '.'),
            $sale->points_earned,
            $sale->points_redeemed,
            number_format($sale->final_amount, 2, ',', '.'),
            $sale->created_at->format('d/m/Y H:i:s'),
        ];
    }
}
