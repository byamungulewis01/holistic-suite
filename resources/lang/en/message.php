<?php

use App\Models\Predefined;

return [
    'attribute' => 'english',
    'hq' => 'Head Quarter',
    'parish' => 'Parish',
    'region' => 'Region',
    'localChurch' => 'Local Church',
    'dashboard' => 'Dashboard',
    'ministries' => Predefined::where('type', 'ministry')->select('id','english as name')->get()->toArray(),
    'marital_status' => Predefined::where('type', 'marital_status')->select('id','english as name')->get()->toArray(),
    'education' => Predefined::where('type', 'education')->select('id','english as name')->get()->toArray(),
    'childrenEducation' => Predefined::where('type', 'childrenEducation')->select('id','english as name')->get()->toArray(),
    'fields' => Predefined::where('type', 'field')->select('id','english as name')->get()->toArray(),
    'saving' => Predefined::where('type', 'saving_type')->select('id','english as name')->get()->toArray(),
    'marital' => Predefined::where('type', 'marital_status')->select('id','english as name')->get()->toArray(),
    'insurance' => Predefined::where('type', 'medical_insurance')->select('id','english as name')->get()->toArray(),
    'services' => Predefined::where('type', 'service')->select('id','english as name')->get()->toArray(),
    'religions' => Predefined::where('type', 'religion')->select('id','english as name')->get()->toArray(),
    'callings' => Predefined::where('type', 'calling')->select('id','english as name')->get()->toArray(),
    'commissions' => Predefined::where('type', 'commission')->select('id','english as name')->get()->toArray(),
    // 'steps' => Predefined::where('type', 'step')->select('id','english as name')->get()->toArray(),
    'steps' => [
        ['id' => 1,'name' => 'Baptisms'],
        ['id' => 2,'name' => 'Marriage'],
    ],
    'trainings' => [
        ['id' => 3,'name' => 'Bible Study'],
        ['id' => 4,'name' => 'Capacity Building'],
        ['id' => 5,'name' => 'Training'],
    ],
    'relation' => [
        ['id' => 1,'name' => 'Head'],
        ['id' => 2,'name' => 'Spouse'],
        ['id' => 3,'name' => 'Child'],
        ['id' => 4,'name' => 'Other'],
    ],
    'teenRelation' => [
        ['id' => 1,'name' => 'Child'],
        ['id' => 2,'name' => 'Other'],
    ],
    'status' => [
        ['id' => 1,'name' => 'Active'],
        ['id' => 2,'name' => 'Passive'],
        ['id' => 3,'name' => 'Restricted'],
        ['id' => 4,'name' => 'Death'],
    ],
    'childrenStatus' => [
        ['id' => 1,'name' => 'Active'],
        ['id' => 2,'name' => 'Passive'],
    ],
    'gender' => [
        ['id' => 1,'name' => 'Male'],
        ['id' => 2,'name' => 'Female'],
    ],
    'orphanStatus' => [
        ['id' => 1,'name' => 'None'],
        ['id' => 2,'name' => 'Father'],
        ['id' => 3,'name' => 'Mother'],
        ['id' => 4,'name' => 'Both'],
    ],
    'callingStatus' => [
        ['id' => 1,'name' => 'Active'],
        ['id' => 2,'name' => 'Inactive'],
    ],
    'sundaySchoolLevel' => [
        ['id' => 1,'name' => 'Level One'],
        ['id' => 2,'name' => 'Level Two'],
        ['id' => 3,'name' => 'Level Three'],
        ['id' => 4,'name' => 'Level Four'],
    ],
    'catchUpLevel' => [
        ['id' => 5,'name' => 'Catch Up One'],
        ['id' => 6,'name' => 'Catch Up Two'],
        ['id' => 7,'name' => 'Catch Up Three'],
        ['id' => 8,'name' => 'Catch Up Four'],
    ],
    'leadersPost' => [
        ['id' => 1,'name' => 'President'],
        ['id' => 2,'name' => 'Vice President'],
        ['id' => 3,'name' => 'Secretary'],
    ],
];
