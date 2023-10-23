<?php

use App\Models\Predefined;

return [
    'attribute' => 'kinyarwanda',
    'hq' => 'Kucyicaro Gikuru',
    'parish' => 'Paruwase',
    'region' => 'Ururembo',
    'localChurch' => 'Umudugudu',
    'dashboard' => 'Ibikorwa By\'Ibanze',
    'ministries' => Predefined::where('type', 'ministry')->select('id','kinyarwanda as name')->get()->toArray(),
    'marital_status' => Predefined::where('type', 'marital_status')->select('id','kinyarwanda as name')->get()->toArray(),
    'education' => Predefined::where('type', 'education')->select('id','kinyarwanda as name')->get()->toArray(),
    'childrenEducation' => Predefined::where('type', 'childrenEducation')->select('id','kinyarwanda as name')->get()->toArray(),
    'fields' => Predefined::where('type', 'field')->select('id','kinyarwanda as name')->get()->toArray(),
    'saving' => Predefined::where('type', 'saving_type')->select('id','kinyarwanda as name')->get()->toArray(),
    'marital' => Predefined::where('type', 'marital_status')->select('id','kinyarwanda as name')->get()->toArray(),
    'insurance' => Predefined::where('type', 'medical_insurance')->select('id','kinyarwanda as name')->get()->toArray(),
    'services' => Predefined::where('type', 'service')->select('id','kinyarwanda as name')->get()->toArray(),
    'religions' => Predefined::where('type', 'religion')->select('id','kinyarwanda as name')->get()->toArray(),
    'callings' => Predefined::where('type', 'calling')->select('id','kinyarwanda as name')->get()->toArray(),
    'commissions' => Predefined::where('type', 'commission')->select('id','kinyarwanda as name')->get()->toArray(),
    // 'steps' => Predefined::where('type', 'step')->select('id','kinyarwanda as name')->get()->toArray(),
    'steps' => [
        ['id' => 1,'name' => 'Umubatizo'],
        ['id' => 2,'name' => 'Inyigisho z\'ubukwe'],
    ],
    'trainings' => [
        ['id' => 3,'name' => 'Inyigisho z\'abibiriya'],
        ['id' => 4,'name' => 'Kongera ubushobozi'],
        ['id' => 5,'name' => 'Amahugurwa'],
    ],
    'relation' => [
        ['id' => 1,'name' => 'Umukuru w\'umuryango'],
        ['id' => 2,'name' => 'Umugore'],
        ['id' => 3,'name' => 'Umwana'],
        ['id' => 4,'name' => 'Uwundi'],
    ],
    'teenRelation' => [
        ['id' => 1,'name' => 'Umwana'],
        ['id' => 2,'name' => 'Uwundi'],
    ],
    'status' => [
        ['id' => 1,'name' => 'Arazwi'],
        ['id' => 2,'name' => 'Ntwabwazwi'],
        ['id' => 3,'name' => 'Yarahagaritswe'],
        ['id' => 4,'name' => 'Yarapfuye'],
    ],
    'childrenStatus' => [
        ['id' => 1,'name' => 'Arazwi'],
        ['id' => 2,'name' => 'Ntwabwazwi'],
    ],
    'gender' => [
        ['id' => 1,'name' => 'Gabo'],
        ['id' => 2,'name' => 'Gore'],
    ],
    'orphanStatus' => [
        ['id' => 1,'name' => 'Oya'],
        ['id' => 2,'name' => 'Papa'],
        ['id' => 3,'name' => 'Mama'],
        ['id' => 4,'name' => 'Bose'],
    ],
    'callingStatus' => [
        ['id' => 1,'name' => 'Arakora'],
        ['id' => 2,'name' => 'Nakora'],
    ],
    'sundaySchoolLevel' => [
        ['id' => 1,'name' => 'Icyiciro cy\'ambere'],
        ['id' => 2,'name' => 'Icyiciro cy\'akabiri'],
        ['id' => 3,'name' => 'Icyiciro cy\'agatatu'],
        ['id' => 4,'name' => 'Icyiciro cy\'akane'],
    ],
    'catchUpLevel' => [
        ['id' => 5,'name' => 'Catch Up y\'ambere'],
        ['id' => 6,'name' => 'Catch Up y\'akabiri'],
        ['id' => 7,'name' => 'Catch Up y\'agatatu'],
        ['id' => 8,'name' => 'Catch Up y\'akane'],
    ],
    'leadersPost' => [
        ['id' => 1,'name' => 'Perezida'],
        ['id' => 2,'name' => 'Visi Perezida'],
        ['id' => 3,'name' => 'Umunyamabanga'],
    ],
    'user-type' => [
        ['id' => 1,'name' => 'Umuyobozi'],
        ['id' => 2,'name' => 'Uwunganira'],
    ],

];
