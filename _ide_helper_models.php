<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Support\Carbon;
/**
 * App\Models\Part
 *
 * @property int $id
 * @property string|null $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Service> $services
 * @property-read int|null $services_count
 * @method static Builder|Part newModelQuery()
 * @method static Builder|Part newQuery()
 * @method static Builder|Part query()
 * @method static Builder|Part whereCreatedAt($value)
 * @method static Builder|Part whereId($value)
 * @method static Builder|Part whereName($value)
 * @method static Builder|Part whereUpdatedAt($value)
 */
	class Part extends Eloquent {}
}

namespace App\Models{use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Support\Carbon;
/**
 * App\Models\Service
 *
 * @property int $id
 * @property int|null $vehicle_id
 * @property int|null $current_mileage
 * @property int|null $part_id
 * @property int|null $shop_id
 * @property int|null $part_warranty
 * @property string|null $part_warranty_period
 * @property int $labor_warranty
 * @property string|null $labor_warranty_period
 * @property string|null $repair_date
 * @property string|null $part_cost
 * @property string|null $labor_cost
 * @property string|null $remarks
 * @property array|null $file
 * @property array|null $file_original_filename
 * @property string|null $image
 * @property string|null $image_original_filename
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Part|null $part
 * @property-read Shop|null $shop
 * @property-read Vehicle|null $vehicle
 * @method static Builder|Service newModelQuery()
 * @method static Builder|Service newQuery()
 * @method static Builder|Service query()
 * @method static Builder|Service whereCreatedAt($value)
 * @method static Builder|Service whereCurrentMileage($value)
 * @method static Builder|Service whereFile($value)
 * @method static Builder|Service whereFileOriginalFilename($value)
 * @method static Builder|Service whereId($value)
 * @method static Builder|Service whereImage($value)
 * @method static Builder|Service whereImageOriginalFilename($value)
 * @method static Builder|Service whereLaborCost($value)
 * @method static Builder|Service whereLaborWarranty($value)
 * @method static Builder|Service whereLaborWarrantyPeriod($value)
 * @method static Builder|Service wherePartCost($value)
 * @method static Builder|Service wherePartId($value)
 * @method static Builder|Service wherePartWarranty($value)
 * @method static Builder|Service wherePartWarrantyPeriod($value)
 * @method static Builder|Service whereRemarks($value)
 * @method static Builder|Service whereRepairDate($value)
 * @method static Builder|Service whereShopId($value)
 * @method static Builder|Service whereUpdatedAt($value)
 * @method static Builder|Service whereVehicleId($value)
 */
	class Service extends Eloquent {}
}

namespace App\Models{use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Support\Carbon;
/**
 * App\Models\Shop
 *
 * @property int $id
 * @property string|null $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Service> $services
 * @property-read int|null $services_count
 * @method static Builder|Shop newModelQuery()
 * @method static Builder|Shop newQuery()
 * @method static Builder|Shop query()
 * @method static Builder|Shop whereCreatedAt($value)
 * @method static Builder|Shop whereId($value)
 * @method static Builder|Shop whereName($value)
 * @method static Builder|Shop whereUpdatedAt($value)
 */
	class Shop extends Eloquent {}
}

namespace App\Models{use Database\Factories\UserFactory;use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Notifications\DatabaseNotification;use Illuminate\Notifications\DatabaseNotificationCollection;use Illuminate\Support\Carbon;use Laravel\Sanctum\PersonalAccessToken;
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 */
	class User extends Eloquent {}
}

namespace App\Models{use Eloquent;use Illuminate\Database\Eloquent\Builder;use Illuminate\Database\Eloquent\Collection;use Illuminate\Support\Carbon;
/**
 * App\Models\Vehicle
 *
 * @property int $id
 * @property string|null $make_model
 * @property int $year
 * @property int $mileage_at_purchase
 * @property string $plate_no
 * @property string|null $vin
 * @property string $registration_date
 * @property string|null $color
 * @property string|null $vehicle_owner
 * @property string $owner_email
 * @property string|null $remarks
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Service> $services
 * @property-read int|null $services_count
 * @method static Builder|Vehicle newModelQuery()
 * @method static Builder|Vehicle newQuery()
 * @method static Builder|Vehicle query()
 * @method static Builder|Vehicle whereColor($value)
 * @method static Builder|Vehicle whereCreatedAt($value)
 * @method static Builder|Vehicle whereId($value)
 * @method static Builder|Vehicle whereMakeModel($value)
 * @method static Builder|Vehicle whereMileageAtPurchase($value)
 * @method static Builder|Vehicle whereOwnerEmail($value)
 * @method static Builder|Vehicle wherePlateNo($value)
 * @method static Builder|Vehicle whereRegistrationDate($value)
 * @method static Builder|Vehicle whereRemarks($value)
 * @method static Builder|Vehicle whereUpdatedAt($value)
 * @method static Builder|Vehicle whereVehicleOwner($value)
 * @method static Builder|Vehicle whereVin($value)
 * @method static Builder|Vehicle whereYear($value)
 */
	class Vehicle extends Eloquent {}
}

