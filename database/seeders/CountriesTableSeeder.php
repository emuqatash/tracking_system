<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{

    public function run()
    {
        $countries = [
            ['name' => 'Afghanistan'],
            ['name' => 'Albania'],
            ['name' => 'Algeria'],
            ['name' => 'American Samoa'],
            ['name' => 'Andorra'],
            ['name' => 'Angola'],
            ['name' => 'Anguilla'],
            ['name' => 'Antarctica'],
            ['name' => 'Antigua and Barbuda'],
            ['name' => 'Argentina'],
            ['name' => 'Armenia'],
            ['name' => 'Aruba'],
            ['name' => 'Australia'],
            ['name' => 'Austria'],
            ['name' => 'Azerbaijan'],
            ['name' => 'Bahamas'],
            ['name' => 'Bahrain'],
            ['name' => 'Bangladesh'],
            ['name' => 'Barbados'],
            ['name' => 'Belarus'],
            ['name' => 'Belgium'],
            ['name' => 'Belize'],
            ['name' => 'Benin'],
            ['name' => 'Bermuda'],
            ['name' => 'Bhutan'],
            ['name' => 'Bolivia'],
            ['name' => 'Bosnia and Herzegowina'],
            ['name' => 'Botswana'],
            ['name' => 'Bouvet Island'],
            ['name' => 'Brazil'],
            ['name' => 'British Indian Ocean Territory'],
            ['name' => 'Brunei Darussalam'],
            ['name' => 'Bulgaria'],
            ['name' => 'Burkina Faso'],
            ['name' => 'Burundi'],
            ['name' => 'Cambodia'],
            ['name' => 'Cameroon'],
            ['name' => 'Canada'],
            ['name' => 'Cape Verde'],
            ['name' => 'Cayman Islands'],
            ['name' => 'Central African Republic'],
            ['name' => 'Chad'],
            ['name' => 'Chile'],
            ['name' => 'China'],
            ['name' => 'Christmas Island'],
            ['name' => 'Cocos Islands'],
            ['name' => 'Colombia'],
            ['name' => 'Comoros'],
            ['name' => 'Congo'],
            ['name' => 'Congo, the Democratic Republic of the'],
            ['name' => 'Cook Islands'],
            ['name' => 'Costa Rica'],
            ['name' => 'Cote dIvoire'],
            ['name' => 'Croatia'],
            ['name' => 'Cuba'],
            ['name' => 'Cyprus'],
            ['name' => 'Czech Republic'],
            ['name' => 'Denmark'],
            ['name' => 'Djibouti'],
            ['name' => 'Dominica'],
            ['name' => 'Dominican Republic'],
            ['name' => 'East Timor'],
            ['name' => 'Ecuador'],
            ['name' => 'Egypt'],
            ['name' => 'El Salvador'],
            ['name' => 'Equatorial Guinea'],
            ['name' => 'Eritrea'],
            ['name' => 'Estonia'],
            ['name' => 'Ethiopia'],
            ['name' => 'Falkland Islands'],
            ['name' => 'Faroe Islands'],
            ['name' => 'Federated States Of Micronesia'],
            ['name' => 'Fiji'],
            ['name' => 'Finland'],
            ['name' => 'France'],
            ['name' => 'France Metropolitan'],
            ['name' => 'French Guiana'],
            ['name' => 'French Polynesia'],
            ['name' => 'French Southern Territories'],
            ['name' => 'Gabon'],
            ['name' => 'Gambia'],
            ['name' => 'Georgia'],
            ['name' => 'Germany'],
            ['name' => 'Ghana'],
            ['name' => 'Gibraltar'],
            ['name' => 'Greece'],
            ['name' => 'Greenland'],
            ['name' => 'Grenada'],
            ['name' => 'Guadeloupe'],
            ['name' => 'Guam'],
            ['name' => 'Guatemala'],
            ['name' => 'Guinea'],
            ['name' => 'Guinea-Bissau'],
            ['name' => 'Guyana'],
            ['name' => 'Haiti'],
            ['name' => 'Heard and Mc Donald Islands'],
            ['name' => 'Holy See - Vatican City State'],
            ['name' => 'Honduras'],
            ['name' => 'Hong Kong'],
            ['name' => 'Hungary'],
            ['name' => 'Iceland'],
            ['name' => 'India'],
            ['name' => 'Indonesia'],
            ['name' => 'Iran (Islamic Republic of)'],
            ['name' => 'Iraq'],
            ['name' => 'Ireland'],
            ['name' => 'Israel'],
            ['name' => 'Italy'],
            ['name' => 'Jamaica'],
            ['name' => 'Japan'],
            ['name' => 'Jordan'],
            ['name' => 'Kazakhstan'],
            ['name' => 'Kenya'],
            ['name' => 'Kiribati'],
            ['name' => 'Korea, Democratic Peoples Republic of'],
            ['name' => 'Korea, Republic of'],
            ['name' => 'Kuwait'],
            ['name' => 'Kyrgyzstan'],
            ['name' => 'Lao, Peoples Democratic Republic'],
            ['name' => 'Latvia'],
            ['name' => 'Lebanon'],
            ['name' => 'Lesotho'],
            ['name' => 'Liberia'],
            ['name' => 'Libyan Arab Jamahiriya'],
            ['name' => 'Liechtenstein'],
            ['name' => 'Lithuania'],
            ['name' => 'Luxembourg'],
            ['name' => 'Macau'],
            ['name' => 'Madagascar'],
            ['name' => 'Malawi'],
            ['name' => 'Malaysia'],
            ['name' => 'Maldives'],
            ['name' => 'Mali'],
            ['name' => 'Malta'],
            ['name' => 'Marshall Islands'],
            ['name' => 'Martinique'],
            ['name' => 'Mauritania'],
            ['name' => 'Mauritius'],
            ['name' => 'Mayotte'],
            ['name' => 'Mexico'],
            ['name' => 'Moldova'],
            ['name' => 'Monaco'],
            ['name' => 'Mongolia'],
            ['name' => 'Montserrat'],
            ['name' => 'Morocco'],
            ['name' => 'Mozambique'],
            ['name' => 'Myanmar'],
            ['name' => 'Namibia'],
            ['name' => 'Nauru'],
            ['name' => 'Nepal'],
            ['name' => 'Netherlands'],
            ['name' => 'Netherlands Antilles'],
            ['name' => 'New Caledonia'],
            ['name' => 'New Zealand'],
            ['name' => 'Nicaragua'],
            ['name' => 'Niger'],
            ['name' => 'Nigeria'],
            ['name' => 'Niue'],
            ['name' => 'Norfolk Island'],
            ['name' => 'Northern Mariana Islands'],
            ['name' => 'Norway'],
            ['name' => 'Oman'],
            ['name' => 'Pakistan'],
            ['name' => 'Palau'],
            ['name' => 'Panama'],
            ['name' => 'Papua New Guinea'],
            ['name' => 'Paraguay'],
            ['name' => 'Peru'],
            ['name' => 'Philippines'],
            ['name' => 'Pitcairn'],
            ['name' => 'Poland'],
            ['name' => 'Portugal'],
            ['name' => 'Puerto Rico'],
            ['name' => 'Qatar'],
            ['name' => 'Reunion'],
            ['name' => 'Romania'],
            ['name' => 'Russian Federation'],
            ['name' => 'Rwanda'],
            ['name' => 'Saint Kitts and Nevis'],
            ['name' => 'Saint Lucia'],
            ['name' => 'Saint Vincent and the Grenadines'],
            ['name' => 'Samoa'],
            ['name' => 'San Marino'],
            ['name' => 'Sao Tome and Principe'],
            ['name' => 'Saudi Arabia'],
            ['name' => 'Senegal'],
            ['name' => 'Seychelles'],
            ['name' => 'Sierra Leone'],
            ['name' => 'Singapore'],
            ['name' => 'Slovakia (Slovak Republic)'],
            ['name' => 'Slovenia'],
            ['name' => 'Solomon Islands'],
            ['name' => 'Somalia'],
            ['name' => 'South Africa'],
            ['name' => 'South Georgia and the South Sandwich Islands'],
            ['name' => 'Spain'],
            ['name' => 'Sri Lanka'],
            ['name' => 'St. Helena'],
            ['name' => 'St. Pierre and Miquelon'],
            ['name' => 'Sudan'],
            ['name' => 'Suriname'],
            ['name' => 'Svalbard and Jan Mayen Islands'],
            ['name' => 'Swaziland'],
            ['name' => 'Sweden'],
            ['name' => 'Switzerland'],
            ['name' => 'Syrian Arab Republic'],
            ['name' => 'Taiwan, Province of China'],
            ['name' => 'Tajikistan'],
            ['name' => 'Tanzania, United Republic of'],
            ['name' => 'Thailand'],
            ['name' => 'The Former Yugoslav Republic of Macedonia'],
            ['name' => 'Togo'],
            ['name' => 'Tokelau'],
            ['name' => 'Tonga'],
            ['name' => 'Trinidad and Tobago'],
            ['name' => 'Tunisia'],
            ['name' => 'Turkey'],
            ['name' => 'Turkmenistan'],
            ['name' => 'Turks and Caicos Islands'],
            ['name' => 'Tuvalu'],
            ['name' => 'Uganda'],
            ['name' => 'Ukraine'],
            ['name' => 'United Arab Emirates'],
            ['name' => 'United Kingdom'],
            ['name' => 'United States'],
            ['name' => 'United States Minor Outlying Islands'],
            ['name' => 'Uruguay'],
            ['name' => 'Uzbekistan'],
            ['name' => 'Vanuatu'],
            ['name' => 'Venezuela'],
            ['name' => 'Vietnam'],
            ['name' => 'Virgin Islands - British'],
            ['name' => 'Virgin Islands - US'],
            ['name' => 'Wallis and Futuna Islands'],
            ['name' => 'Western Sahara'],
            ['name' => 'Yemen'],
            ['name' => 'Yugoslavia'],
            ['name' => 'Zambia'],
            ['name' => 'Zimbabwe'],
        ];

        foreach ($countries as $country) {
            DB::table('countries')->insert($country);
        }
    }
}