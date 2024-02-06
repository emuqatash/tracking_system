<?php

namespace App\Filament\Widgets;

use App\Models\DrivingLicense;
use App\Models\Miscellaneous;
use App\Models\Service;
use App\Models\Vehicle;
use Closure;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;
    protected static ?string $pollingInterval = '10s';
    protected static bool $isLazy = true;
    protected static ?int $navigationSort = 0;

    protected function getStats(): array
    {
        return [
            Stat::make('Vehicle Service Due',
                Service::whereColumn('current_mileage', '>=', 'followup_mileage')
                    ->orWhere('followup_date', '<=', now())
                    ->count())
                ->color('danger')
                ->descriptionIcon('heroicon-o-wrench-screwdriver')
                ->description('Total Vehicle service\'s requires maintenance '),

            Stat::make('Expired Car Registration',
                Vehicle::whereRaw('registration_date <= (CURRENT_DATE + INTERVAL remind_before DAY)')
                    ->count())
                ->color('danger')
                ->description('Total Car licenses overdue for renewal')
                ->descriptionIcon('heroicon-m-truck')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
//                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'Expired Registration' })",
                ]),

            Stat::make('Expired Driving License',
                DrivingLicense::whereRaw('expiry_date <= (CURRENT_DATE + INTERVAL remind_before DAY)')
                    ->count())
                ->color('danger')
                ->descriptionIcon('heroicon-o-clipboard-document')
                ->description('Total Driving licenses overdue for renewal'),

            Stat::make('Miscellaneous',
                Miscellaneous::whereRaw('followup_date <= (CURRENT_DATE + INTERVAL followup_before_day DAY)')
                    ->count())
                ->color('danger')
                ->descriptionIcon('heroicon-o-briefcase')
                ->description('Total Miscellaneous requires attention'),
        ];
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn(Vehicle $record): string => route('filament.dashboard.resources.vehicles.index',
            ['record' => $record]);
    }
}









//protected function getStats(): array
//{
//    $stats = [];
//    $expiredCarLicenseCount = Vehicle::where('registration_date', '<=', now()->addDays(30))->count();
//    if ($expiredCarLicenseCount > 0) {
//        $stats[] = Stat::make('Expired Car License', $expiredCarLicenseCount)
//            ->color('danger')
//            ->description('Total Car licenses overdue for renewal');
//    }
//
//    $tireRotationCount = Service::where('part_id', '=', '21')
//        ->where(function ($query) {
//            $query->whereColumn('current_mileage', '>=', 'followup_mileage')
//                ->orWhere('followup_date', '<=', now());
//        })
//        ->count();
//    if ($tireRotationCount > 0) {
//        $stats[] = Stat::make('Tire Rotation and Balancing', $tireRotationCount)
//            ->color('danger')
//            ->description('Total Car requires tire rotation and balancing');
//    }
//
//    $expiredDrivingLicenseCount = DrivingLicense::where('expiry_date', '<=', now()->addDays(90))->count();
//    if ($expiredDrivingLicenseCount > 0) {
//        $stats[] = Stat::make('Expired Driving License', $expiredDrivingLicenseCount)
//            ->color('danger')
//            ->description('Total Driving licenses overdue for renewal');
//    }
//
//    $miscellaneousCount = Miscellaneous::whereRaw('followup_date <= (CURRENT_DATE + INTERVAL 7 DAY)')->count();
//    if ($miscellaneousCount > 0) {
//        $stats[] = Stat::make('Miscellaneous', $miscellaneousCount)
//            ->color('danger')
//            ->description('Total miscellaneous stats');
//    }
//    return $stats;
//}


//            Stat::make('Expired Car License', $this->getPageTableQuery()->count())
//                ->description($this->getPageTableQuery()->count())
//                ->descriptionIcon('heroicon-m-truck')
//                ->extraAttributes([
//                    'class' => 'cursor-pointer'
//                ]),
