<?php
class StaticArray
{

    public static $orderStatus = [
        0 => 'ORDER_STATUS_NEW',
        1 => 'ORDER_STATUS_PROVIDER_CANCELLED',
        2 => 'ORDER_STATUS_DELIVERY_CANCELLED',
        3 => 'ORDER_STATUS_DELIVERY_ASSIGNED',
        4 => 'ORDER_STATUS_DELIVERY_ACCEPTED',
        5 => 'ORDER_STATUS_DELIVERY_LOADING',
        6 => 'ORDER_STATUS_DELIVERY_CONFIRMED',
        7 => 'ORDER_STATUS_DELIVERY_USER_REFUSE',
        8 => 'ORDER_STATUS_ADMIN_REFUSE',
        9 => 'ORDER_STATUS_DELIVERY_STARTED'
    ];

    public static $orderDeliverySteps = [
        2 => ['name' => 'DELIVERY_CANCELLED' , 'color' => 'danger'],
        4 => ['name' => 'DELIVERY_ACCEPTED' , 'color' => 'success'],
        5 => ['name' => 'DELIVERY_LOADING' , 'color' => 'primary'],
        6 => ['name' => 'DELIVERY_CONFIRMED' , 'color' => 'info'],
        7 => ['name' => 'DELIVERY_USER_REFUSE' , 'color' => 'danger'],
        9 => ['name' => 'DELIVERY_STARTED' , 'color' => 'success'],
    ];

}