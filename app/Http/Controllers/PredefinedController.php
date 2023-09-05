<?php

namespace App\Http\Controllers;

use App\Models\Predefined;
use Illuminate\Http\Request;

class PredefinedController extends Controller
{
    //index
    public function index()
    {
        $ministries = Predefined::where('type', 'ministry')->orderBy('english')->get();
        $fields = Predefined::where('type', 'field')->orderBy('english')->get();
        $education = Predefined::where('type', 'education')->orderBy('english')->get();
        $childrenEducation = Predefined::where('type', 'childrenEducation')->orderBy('english')->get();
        return view('predefined.first', compact('ministries', 'fields', 'education', 'childrenEducation'));
    }
    public function second()
    {
        $insurance = Predefined::where('type', 'medical_insurance')->orderBy('english')->get();
        $saving = Predefined::where('type', 'saving_type')->orderBy('english')->get();
        $marital = Predefined::where('type', 'marital_status')->orderBy('english')->get();
        $services = Predefined::where('type', 'service')->orderBy('english')->get();
        return view('predefined.second', compact('insurance', 'saving', 'marital', 'services'));
    }
    public function third()
    {
        $religions = Predefined::where('type', 'religion')->orderBy('english')->get();
        $callings = Predefined::where('type', 'calling')->orderBy('english')->get();
        $steps = Predefined::where('type', 'step')->orderBy('english')->get();
        $commissions = Predefined::where('type', 'commission')->orderBy('english')->get();
        return view('predefined.third', compact('religions','callings','steps','commissions'));
    }
    public function fourth()
    {
        return view('predefined.fourth');
    }

    // storeMinistry
    public function storeMinistry(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);
        // where type is ministry no duplicate of english and kinyarwanda

        $ministry = Predefined::where('type', 'ministry')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($ministry) {
            return redirect()->back()->with('error', 'Ministry already exists');
        }

        $request->merge(['type' => 'ministry',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Ministry added successfully');
    }
    // updateMinistry
    public function updateMinistry(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);
        $existingRecord = Predefined::where('type', 'ministry')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Ministry already exists');
        }


        $ministry = Predefined::findOrFail($id);
        $ministry->update($request->all());
        return redirect()->back()->with('success', 'Ministry updated successfully');
    }
    // destroyMinistry
    public function destroyMinistry($id)
    {
        $ministry = Predefined::findOrFail($id);
        $ministry->delete();
        return redirect()->back()->with('success', 'Ministry deleted successfully');
    }

    // storeField
    public function storeField(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $field = Predefined::where('type', 'field')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($field) {
            return redirect()->back()->with('error', 'Field already exists');
        }
        $request->merge(['type' => 'field',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Field added successfully');
    }
    // updateField
    public function updateField(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $existingRecord = Predefined::where('type', 'education')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Education already exists');
        }

        $field = Predefined::findOrFail($id);
        $field->update($request->all());
        return redirect()->back()->with('success', 'Field updated successfully');
    }
    // destroyField
    public function destroyField($id)
    {
        $field = Predefined::findOrFail($id);
        $field->delete();
        return redirect()->back()->with('success', 'Field deleted successfully');
    }

    // storeEducation
    public function storeEducation(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $education = Predefined::where('type', 'education')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($education) {
            return redirect()->back()->with('error', 'Education already exists');
        }
        $request->merge(['type' => 'education',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Education added successfully');
    }
    // updateEducation
    public function updateEducation(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);


        $existingRecord = Predefined::where('type', 'education')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Education already exists');
        }

        $education = Predefined::findOrFail($id);
        $education->update($request->all());
        return redirect()->back()->with('success', 'Education updated successfully');
    }
    // destroyEducation
    public function destroyEducation($id)
    {
        $education = Predefined::findOrFail($id);
        $education->delete();
        return redirect()->back()->with('success', 'Education deleted successfully');
    }
    // storeEducation
    public function storeChildrenEducation(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $education = Predefined::where('type', 'childrenEducation')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($education) {
            return redirect()->back()->with('error', 'Education already exists');
        }
        $request->merge(['type' => 'childrenEducation',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Education added successfully');
    }
    // updateEducation
    public function updateChildrenEducation(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);


        $existingRecord = Predefined::where('type', 'childrenEducation')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Education already exists');
        }

        $education = Predefined::findOrFail($id);
        $education->update($request->all());
        return redirect()->back()->with('success', 'Education updated successfully');
    }
    // destroyEducation
    public function destroyChildrenEducation($id)
    {
        $education = Predefined::findOrFail($id);
        $education->delete();
        return redirect()->back()->with('success', 'Education deleted successfully');
    }
    // storeMedicalInsurance
    public function storeMedicalInsurance(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $insurance = Predefined::where('type', 'medical_insurance')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($insurance) {
            return redirect()->back()->with('error', 'Medical insurance already exists');
        }
        $request->merge(['type' => 'medical_insurance',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Medical insurance added successfully');
    }
    // updateMedicalInsurance
    public function updateMedicalInsurance(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $existingRecord = Predefined::where('type', 'medical_insurance')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Medical insurance already exists');
        }
        $insurance = Predefined::findOrFail($id);
        $insurance->update($request->all());
        return redirect()->back()->with('success', 'Medical insurance updated successfully');
    }
    // destroyMedicalInsurance
    public function destroyMedicalInsurance($id)
    {
        $insurance = Predefined::findOrFail($id);
        $insurance->delete();
        return redirect()->back()->with('success', 'Medical insurance deleted successfully');
    }
    // storeSavingType
    public function storeSavingType(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $saving = Predefined::where('type', 'saving_type')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($saving) {
            return redirect()->back()->with('error', 'Saving type already exists');
        }
        $request->merge(['type' => 'saving_type',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Saving type added successfully');
    }
    // updateSavingType
    public function updateSavingType(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);


        $existingRecord = Predefined::where('type', 'saving_type')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Saving type already exists');
        }
        $saving = Predefined::findOrFail($id);
        $saving->update($request->all());
        return redirect()->back()->with('success', 'Saving type updated successfully');
    }
    // destroySavingType
    public function destroySavingType($id)
    {
        $saving = Predefined::findOrFail($id);
        $saving->delete();
        return redirect()->back()->with('success', 'Saving type deleted successfully');
    }
    // storeReligion
    public function storeReligion(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);
        $relation = Predefined::where('type', 'religion')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($relation) {
            return redirect()->back()->with('error', 'Religion already exists');
        }
        $request->merge(['type' => 'religion',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Religion added successfully');
    }
    // updateReligion
    public function updateReligion(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $existingRecord = Predefined::where('type', 'religion')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Religion already exists');
        }
        $relation = Predefined::findOrFail($id);
        $relation->update($request->all());
        return redirect()->back()->with('success', 'Religion updated successfully');
    }
    // destroyReligion
    public function destroyReligion($id)
    {
        $relation = Predefined::findOrFail($id);
        $relation->delete();
        return redirect()->back()->with('success', 'Religion deleted successfully');
    }
    // // storeStatus
    public function storeService(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);
        $status = Predefined::where('type', 'service')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($status) {
            return redirect()->back()->with('error', 'Service already exists');
        }
        $request->merge(['type' => 'service',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Service added successfully');
    }
    // updateStatus
    public function updateService(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $existingRecord = Predefined::where('type', 'service')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Service already exists');
        }
        $status = Predefined::findOrFail($id);
        $status->update($request->all());
        return redirect()->back()->with('success', 'Service updated successfully');
    }
    // destroyStatus
    public function destroyService($id)
    {
        $status = Predefined::findOrFail($id);
        $status->delete();
        return redirect()->back()->with('success', 'Service deleted successfully');
    }
    // storeMaritalStatus
    public function storeMaritalStatus(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $marital = Predefined::where('type', 'marital_status')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($marital) {
            return redirect()->back()->with('error', 'Marital status already exists');
        }
        $request->merge(['type' => 'marital_status',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Marital status added successfully');
    }
    // updateMaritalStatus
    public function updateMaritalStatus(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $existingRecord = Predefined::where('type', 'marital_status')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Marital status already exists');
        }

        $marital = Predefined::findOrFail($id);
        $marital->update($request->all());
        return redirect()->back()->with('success', 'Marital status updated successfully');
    }
    // destroyMaritalStatus
    public function destroyMaritalStatus($id)
    {
        $marital = Predefined::findOrFail($id);
        $marital->delete();
        return redirect()->back()->with('success', 'Marital status deleted successfully');
    }
    // storeCalling
    public function storeCalling(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $marital = Predefined::where('type', 'calling')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($marital) {
            return redirect()->back()->with('error', 'Calling Category already exists');
        }
        $request->merge(['type' => 'calling',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Calling Category added successfully');
    }
    // updateCalling
    public function updateCalling(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $existingRecord = Predefined::where('type', 'calling')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Calling Category already exists');
        }

        $marital = Predefined::findOrFail($id);
        $marital->update($request->all());
        return redirect()->back()->with('success', 'Calling Category updated successfully');
    }
    // destroyCalling
    public function destroyStep($id)
    {
        $marital = Predefined::findOrFail($id);
        $marital->delete();
        return redirect()->back()->with('success', 'Calling Category deleted successfully');
    }
    // storeStep
    public function storeStep(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $marital = Predefined::where('type', 'step')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($marital) {
            return redirect()->back()->with('error', 'Step Category already exists');
        }
        $request->merge(['type' => 'step',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Calling Category added successfully');
    }
    // updateCalling
    public function updateStep(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $existingRecord = Predefined::where('type', 'step')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Step Category already exists');
        }

        $marital = Predefined::findOrFail($id);
        $marital->update($request->all());
        return redirect()->back()->with('success', 'Step Category updated successfully');
    }
    // destroyCommission
    public function destroyCalling($id)
    {
        $marital = Predefined::findOrFail($id);
        $marital->delete();
        return redirect()->back()->with('success', 'Step Category deleted successfully');
    }
    // storeCommission
    public function storeCommission(Request $request)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $marital = Predefined::where('type', 'commission')->where('english', $request->english)->orWhere('kinyarwanda', $request->kinyarwanda)->first();
        if ($marital) {
            return redirect()->back()->with('error', 'Commission already exists');
        }
        $request->merge(['type' => 'commission',]);
        Predefined::create($request->all());
        return redirect()->back()->with('success', 'Commission added successfully');
    }
    // updateCommission
    public function updateCommission(Request $request, $id)
    {
        $request->validate([
            'english' => 'required',
            'kinyarwanda' => 'required',
        ]);

        $existingRecord = Predefined::where('type', 'commission')
        ->where(function ($query) use ($request) {
            $query->where('english', $request->english)
                  ->orWhere('kinyarwanda', $request->kinyarwanda);
        })
        ->where('id', '!=', $request->id) // Exclude the current record being updated.
        ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Commission already exists');
        }

        $marital = Predefined::findOrFail($id);
        $marital->update($request->all());
        return redirect()->back()->with('success', 'Commission updated successfully');
    }
    // destroyCommission
    public function destroyCommission($id)
    {
        $marital = Predefined::findOrFail($id);
        $marital->delete();
        return redirect()->back()->with('success', 'Commission deleted successfully');
    }

}
