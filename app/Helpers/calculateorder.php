<?php

public static function calculateOrderTotals(VendorOrder $order, $gstPercent = 3.0, $isInterstate = false)
{
    $items = $order->items;
    $metal = 0;
    $making = 0;
    foreach ($items as $item) {
        $item_metal = bcmul((string)$item->rate_per_gram, (string)$item->weight * $item->quantity, 2);
        // Note: if weight has decimals, compute carefully
        $metal += (float)$item_metal;
        $making += (float)($item->making_charges * $item->quantity);
        // Update item_metal_value and item_total if needed:
        $item->item_metal_value = round($item_metal, 2);
        $item->item_total = round($item_metal + ($item->making_charges * $item->quantity), 2);
        $item->saveQuietly();
    }

    $subTotal = $metal + $making;
    $discount = (float)$order->discount;
    $taxable = max(0, $subTotal - $discount);

    $totalTax = round($taxable * ($gstPercent/100), 2);

    if ($isInterstate) {
        $igst = $totalTax;
        $cgst = $sgst = 0;
    } else {
        $igst = 0;
        $cgst = round($totalTax / 2, 2);
        $sgst = round($totalTax / 2, 2);
    }

    $totalAmount = round($taxable + $totalTax, 2);

    $order->metal_value = round($metal, 2);
    $order->making_total = round($making, 2);
    $order->sub_total = round($subTotal, 2);
    $order->taxable_value = round($taxable, 2);
    $order->cgst = $cgst;
    $order->sgst = $sgst;
    $order->igst = $igst;
    $order->total_amount = $totalAmount;
    $order->balance_amount = round($totalAmount - $order->paid_amount, 2);
    $order->save();

    return $order;
}

