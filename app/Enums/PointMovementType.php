<?php

namespace App\Enums;

enum PointMovementType: string
{
    case EarnedFromSale = 'earned_from_sale';
    case RedeemedForDiscount = 'redeemed_for_discount';
    case AdminAdjustmentAdd = 'admin_adjustment_add';
    case AdminAdjustmentSubtract = 'admin_adjustment_subtract';


    public function label(): string
    {
        return match ($this) {
            self::EarnedFromSale => 'Pontos ganhos com venda',
            self::RedeemedForDiscount => 'Pontos resgatados para desconto',
            self::AdminAdjustmentAdd => 'Ajuste de pontos (adição)',
            self::AdminAdjustmentSubtract => 'Ajuste de pontos (subtração)',
        };
    }
}
