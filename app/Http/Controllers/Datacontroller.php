<?php

namespace App\Http\Controllers;
use App\Constants\QuarterStatus;
use App\Mail\ApprovePayment;
use App\Mail\ApproveSectioning;
use App\Mail\AssessmentCreated;
use App\Mail\EditAssessment;
use App\Models\address;
use App\Models\assign;
use App\Models\classes;
use App\Models\corevalues;
use App\Models\grade;
use App\Models\previous_primary;
use App\Models\previous_school;
use App\Models\previous_secondary;
use App\Models\register_form;
use App\Models\required_docs;
use App\Models\studentdetails;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use App\Models\payment_form;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\NullableType;
use App\Mail\ApproveStudent;
use App\Mail\PendingPayment;
use App\Mail\PendingStudent;
use App\Models\assessment;
use App\Models\section;
use App\Models\subject;
use App\Models\QuarterSettings;
use App\Models\teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail as FacadesMail;


class Datacontroller extends Controller
{

    public function partialaccountpost(Request $request)
    {

        $validateData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'suffix' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        FacadesMail::to($validateData['email'])->send(new PendingStudent($validateData));

        $validateData['status'] = 'pending';
        register_form::create($validateData);
        return redirect('/login');
    }


    public function loginPost(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8'
    ]);

    // Define default credentials
    $defaultCredentials = [
        'Teacher' => ['email' => 'teacher@example.com', 'password' => 'teacher123'],
        'Principal' => ['email' => 'principal@example.com', 'password' => 'principal123'],
        'Cashier' => ['email' => 'cashier@example.com', 'password' => 'cashier123'],
        'Record' => ['email' => 'record@example.com', 'password' => 'record123'],
        'Accounting' => ['email' => 'accounting@example.com', 'password' => 'accounting123'],
    ];

    // Check for default credentials
    foreach ($defaultCredentials as $role => $default) {
        if ($credentials['email'] === $default['email'] && $credentials['password'] === $default['password']) {
            // Create a user instance with the role
            $user = User::where('email', $default['email'])->first();
            if ($user) {
                Auth::login($user); // Log in the user
                sweetalert()->success("Welcome {$role}!");
                return redirect(strtolower($role))->with('success', "Welcome, {$role}!");
            }
        }
    }

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        switch ($user->role) {
            case 'Teacher':
                return redirect('/teacher')->with('success', 'Welcome, Teacher!');

                case 'NewstudentFill':
                
                    $registerForm = register_form::where('user_id', $user->id)->first();
         
                    if ($registerForm) {
                        if ($registerForm->status === register_form::STATUS_APPROVED) {

                            return redirect('/studentdetails/' . $registerForm->id)
                                ->with('success', 'Welcome, New Student!');
                        } else {

                            sweetalert()->warning('Your account is pending approval.');
                            return redirect('/login')->with('error', 'Your registration is still pending approval.');
                        }
                    } else {

                        sweetalert()->warning('No registration details found.');
                        return redirect('/login')->with('error', 'No registration details found.');
                    }
            case 'NewStudent':
                return redirect('/studentdashboard')->with('success', 'Welcome, New Student!');

            case 'OldStudent':
                return redirect('/oldstudentdashboard')->with('success', 'Welcome, Old Student!');

            case 'Record':
                sweetalert()->success('Welcome Records!');
                return redirect('/record')->with('success', 'Welcome, Record!');

            case 'Cashier':
                sweetalert()->success('Welcome Cashier!');
                return redirect('/cashier')->with('success', 'Welcome, Cashier!');

            case 'Principal':
                sweetalert()->success('Welcome Principal!');
                return redirect('/principal')->with('success', 'Welcome, Principal!');

            case 'Accounting':
                sweetalert()->success('Welcome Accounting!');
                return redirect('/accounting')->with('success', 'Welcome, Accounting!');

            default:
                return back()->with('error', 'Invalid user role.');
        }
    } else {
        sweetalert()->error('Pending account approval. Please try again.');
        return redirect('/login')->withErrors([
            'email' => 'The provided email is incorrect.',
            'password' => 'The provided password is incorrect.',
        ])->onlyInput('email');
    }
}


    public function adminuserspost(Request $request)
    {

        $validateData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'suffix' => 'required',
            'role' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        User::create($validateData);
        return redirect('/adminusers');
    }

    public function studentdetailspost(Request $request)
{
    $user = Auth::user();

    $registerForm = register_form::where('user_id', $user->id)->first();

    if (!$registerForm) {
        return redirect()->back()->with('error', 'No registration form found for the current user.');
    }

    $validateData = $request->validate([
        'firstname' => 'required',
        'middlename' => 'required',
        'lastname' => 'required',
        'suffix' => 'required',
        'nationality' => 'required',
        'gender' => 'required',
        'civilstatus' => 'required',
        'birthdate' => 'required',
        'birthplace' => 'required',
        'religion' => 'required',
        'mother_name' => 'required',
        'mother_occupation' => 'required',
        'mother_contact' => 'required',
        'father_name' => 'required',
        'father_occupation' => 'required',
        'father_contact' => 'required',
        'guardian_name' => 'required',
        'guardian_occupation' => 'required',
        'guardian_contact' => 'required',

        'details_id' => 'required|in:' . $registerForm->id,
    ]);

    $validateData['status'] = 'pending';

    studentdetails::create($validateData);

    if ($registerForm->status === register_form::STATUS_APPROVED) {
        return redirect('/address_contact/' . $registerForm->id)->with('success', 'Welcome, New Student!');
    } else {
        return redirect('/studentdetails')->with('error', 'Your registration is still pending approval.');
    }
}


public function address_contactpost(Request $request)
{
    $validateData = $request->validate([
        'zipcode' => 'required',
        'province' => 'required',
        'city' => 'required',
        'barangay' => 'required',
        'streetaddress' => 'required',
        'address_id' => 'required|exists:register_form,id',
    ]);

    $validateData['status'] = 'pending';

    address::create($validateData);
    $user = Auth::user();
    $registerForm = register_form::where('user_id', $user->id)->first();
        if ($registerForm->status === register_form::STATUS_APPROVED) {
            return redirect('/previous_school/' . $registerForm->id)->with('success', 'Address and contact submitted successfully.');
        } else {
            return redirect('/address_contact')->with('error', 'Your registration is still pending approval.');
        }
   }
    public function recordapprovalpost(Request $request)
{
    $validateData = $request->validate([
        'id' => 'required|exists:register_form,id', 
        'firstname' => 'required',
        'lastname' => 'required',
        'middlename' => 'required',
        'suffix' => 'required',
        'role' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
    ]);

    // Create the userge
    $user = User::create([
        'firstname' => $validateData['firstname'],
        'lastname' => $validateData['lastname'],
        'middlename' => $validateData['middlename'],
        'suffix' => $validateData['suffix'],
        'role' => 'NewstudentFill',
        'email' => $validateData['email'], 
        'password' => bcrypt($validateData['password']), 
    ]);

    FacadesMail::to($user->email)->send(new ApproveStudent($user));

    $user->role = 'NewstudentFill';

    $registerForm = register_form::findOrFail($validateData['id']);
    $registerForm->status = register_form::STATUS_APPROVED;
    $registerForm->user_id = $user->id;
    $registerForm->save();

    sweetalert()->success('You have approved the student and created a user!');
    return redirect('/studentapplicant'); 
}

    public function previous_schoolpost(Request $request)
    {
        $validateData = $request->validate([
            'second_school_name' => 'required',
            'second_last_year_level' => 'required',
            'second_school_year_from' => 'required|digits:4|integer|min:1900|max:2100',
            'second_school_year_to' => 'required|digits:4|integer|min:1900|max:2100|gte:second_school_year_from',
            'second_school_type' => 'required',

            'primary_school_name' => 'required',
            'primary_last_year_level' => 'required',
            'primary_school_year_from' => 'required|digits:4|integer|min:1900|max:2100',
            'primary_school_year_to' => 'required|digits:4|integer|min:1900|max:2100|gte:primary_school_year_from',
            'primary_school_type' => 'required',

            'school_id' => 'required|exists:register_form,id',
        ]);

        $validatedData['status'] = 'pending';

        previous_school::create($validateData);

        $user = Auth::user();
        $registerForm = register_form::where('user_id', $user->id)->first();
            if ($registerForm->status === register_form::STATUS_APPROVED) {
                return redirect('/required_documents/' . $registerForm->id)->with('success', 'Previous school submitted successfully.');
            } else {
                // Handle case where status is not approved
               
                return redirect('/previous_school')->with('error', 'Your registration is still pending approval.');
            }
        
         }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('success', 'You have been logged out.');
    }

    public function required_documents_post(Request $request)
{
    $validateData = $request->validate([
        'type' => 'required|array',
        'type.*' => 'string|distinct', 
        'documents' => 'required|array',
        'documents.*' => 'file|max:10240|mimes:jpg,png,pdf',
        'required_id' => 'required|exists:register_form,id',
    ]);

    $uploadedTypes = []; 
    $filesUploaded = []; 

    foreach ($request->file('documents') as $index => $file) {
        $docType = $validateData['type'][$index];

        if (in_array($docType, $uploadedTypes)) {
            continue; 
        }

        $filePath = $file->store('documents', 'public');

        required_docs::create([
            'type' => $docType,
            'documents' => $filePath,
            'required_id' => $validateData['required_id'],
        ]);

        $uploadedTypes[] = $docType;
        $filesUploaded[] = $filePath;
    }

    $user = Auth::user();
    $registerForm = register_form::where('user_id', $user->id)->first();

    if ($registerForm->status === register_form::STATUS_APPROVED) {
        return redirect('/payment_process/' . $registerForm->id)->with('success', 'Required Documents submitted successfully.');
    } else {
        return redirect('/previous_school')->with('error', 'Your registration is still pending approval.');
    }
}

    public function payment_processpost(Request $request)
    {
        $request->validate([
            'payment-proof' => 'required|image|mimes:jpg,jpeg,png,bmp|max:2048',
            'level' => 'required|string',
            'payment-details' => 'required|string|max:1000',
            'payment_id' => 'required|integer|exists:register_form,id',
        ]);

        if ($request->hasFile('payment-proof')) {
            $file = $request->file('payment-proof');
            $filePath = $file->store('payment_proofs', 'public');

            $amount = 500;  
            $feeType = 'Enrollment Fee'; 

            $payment = new payment_form();
            $payment->fee_type = $feeType;
            $payment->amount = $amount;
            $payment->payment_proof = $filePath;
            $payment->payment_details = $request->input('payment-details');
            $payment->payment_id = $request->input('payment_id');
            $payment->level = $request->input('level');
            $payment->save();

            $user = Auth::user();
            if ($user instanceof User) {
                $user->role = 'NewStudent';
                $user->save();

                FacadesMail::to($user->email)->send(new PendingPayment($user->toArray(), $amount, $feeType));
            }
            
        }
        return redirect('/enrollmentstep')->with('success', 'Payment submitted successfully!');
    }

    public function updatedetailspost(Request $request)
{
    $validateData = $request->validate([
        'firstname' => 'required',
        'middlename' => 'required',
        'lastname' => 'required',
        'suffix' => 'required',
        'nationality' => 'required',
        'gender' => 'required',
        'civilstatus' => 'required',
        'birthdate' => 'required',
        'birthplace' => 'required',
        'religion' => 'required',
        'mother_name' => 'required',
        'mother_occupation' => 'required',
        'mother_contact' => 'required',
        'father_name' => 'required',
        'father_occupation' => 'required',
        'father_contact' => 'required',
        'guardian_name' => 'required',
        'guardian_occupation' => 'required',
        'guardian_contact' => 'required',
    ]);

    $userId = Auth::user()->id;

    $registerForm = \App\Models\register_form::where('user_id', $userId)->first();

    if (!$registerForm) {
        return redirect()->route('enrollment.step')->withErrors('No registration form found.');
    }

    $studentDetail = \App\Models\StudentDetails::where('details_id', $registerForm->id)->first();

    if ($studentDetail) {

        $studentDetail->update($validateData);
        
        $studentDetail->status = 'approved';
        $studentDetail->save();

        return redirect()->route('enrollment.step')->with('success', 'Student details updated successfully.');
    } else {
        return redirect()->route('enrollment.step')->withErrors('Student details not found.');
    }
}

    public function updateaddresspost(Request $request)
    {
        $validateData = $request->validate([
            'zipcode' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'streetaddress' => 'required',
            
        ]);
        $userId = Auth::user()->id;
    
        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();

        $address = \App\Models\address::where('address_id', $registerForm->id)->first();

        if ($address) {

            $address->update($validateData);

            $address->status = 'approved';
            $address->save();

            return redirect()->route('enrollment.step')->with('success', 'Address details updated successfully.');
        } else {
            return redirect()->route('enrollment.step')->withErrors('Address details not found.');
        }
    }

    public function updateschoolpost(Request $request)
    {
        $validateData = $request->validate([
            'second_school_name' => 'required',
            'second_last_year_level' => 'required',
            'second_school_year_from' => 'required',
            'second_school_year_to' => 'required',
            'second_school_type' => 'required',

            'primary_school_name' => 'required',
            'primary_last_year_level' => 'required',
            'primary_school_year_from' => 'required',
            'primary_school_year_to' => 'required',
            'primary_school_type' => 'required',

        ]);

        $userId = Auth::user()->id;

        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();
    
        $previousSchool = \App\Models\previous_school::where('school_id', $registerForm->id)->first();
        
        if ($previousSchool) {

            $previousSchool->update($validateData);

            $previousSchool->status = 'approved';
            $previousSchool->save();

            return redirect()->route('enrollment.step')->with('success', 'Previous school details updated successfully.');
        } else {
            return redirect()->route('enrollment.step')->withErrors('Previous school details not found.');
        }
    }


    public function updatedocumentspost(Request $request)
    {
        // Validate the request data
        $validateData = $request->validate([
            'type' => 'required|array',
            'type.*' => 'string|distinct',
            'documents' => 'nullable|array',
            'documents.*' => 'file|max:10240|mimes:jpg,png,pdf',
            'required_id' => 'required|integer',
        ]);
    
        $userId = Auth::user()->id;
        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();
    
        if (!$registerForm) {
            return redirect()->route('enrollment.step')->withErrors('Register form not found.');
        }
    
        // Find the required documents based on the registerForm ID
        $requiredDocs = \App\Models\required_docs::where('required_id', $registerForm->id)->first();
    
        if ($this->documentsUploaded($request)) {
            return $this->handleDocumentUpload($validateData, $requiredDocs);
        }
    
        return $this->approveExistingDocuments($request, $validateData['required_id'], $requiredDocs);
    }

    private function documentsUploaded($request)
    {
        return $request->has('documents') && count($request->file('documents')) > 0;
    }

        private function handleDocumentUpload($validateData, $requiredDocs)
    {
        $uploadedTypes = [];

        foreach ($validateData['documents'] as $index => $file) {
            $docType = $validateData['type'][$index];

            // Check if the document type already exists
            if (in_array($docType, $uploadedTypes)) {
                continue;
            }

            // Store the uploaded document
            $filePath = $file->store('documents', 'public');

            // Create a new record in required_docs
            required_docs::create([
                'type' => $docType,
                'documents' => $filePath,
                'required_id' => $validateData['required_id'],
                'status' => 'approved', 
            ]);

            $uploadedTypes[] = $docType; 
        }

        return redirect()->route('enrollment.step')->with('success', 'Documents uploaded and approved successfully.');
    }

    public function approveExistingDocuments(Request $request, $requiredId, $requiredDocs)
    {
        $request->validate([
            'required_id' => 'required|integer',
        ]);
    
        // Optionally, check if $requiredDocs is not null or meets specific criteria
        if (!$requiredDocs) {
            return redirect()->route('enrollment.step')->withErrors('No required documents found for the selected ID.');
        }
    
        $existingDocs = required_docs::where('required_id', $requiredId)->get();
    
        if ($existingDocs->isNotEmpty()) {
            foreach ($existingDocs as $doc) {
                $doc->update(['status' => 'approved']);
            }
            return redirect()->route('enrollment.step')->with('success', 'Documents approved successfully.');
        }
    
        return redirect()->route('enrollment.step')->withErrors('No documents found for the required ID.');
    }

    public function updateDocuments(Request $request)
    {
        // Validate the request data
        $request->validate([
            'required_id' => 'required|integer',
        ]);

        // Retrieve the authenticated user's ID
        $userId = Auth::user()->id;

        // Find the register form associated with the authenticated user
        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();

        if (!$registerForm) {
            return redirect()->route('enrollment.step')->withErrors('Register form not found.');
        }

        // Find the required documents based on the registerForm ID
        $requiredDocs = \App\Models\required_docs::where('required_id', $registerForm->id)->first();

        // Call the approveExistingDocuments method, passing the request and the requiredDocs
        return $this->approveExistingDocuments($request, $request->required_id, $requiredDocs);
    }

    public function enrollmentStep()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $user = Auth::user();
    
        $registerForm = register_form::where('user_id', $user->id)->first();
    
        if (!$registerForm) {
            return redirect()->route('/enrollmentstep')->with('error', 'No registration form found.');
        }
    
        $registerFormId = $registerForm->id;
    
        $studentDetail = studentdetails::where('details_id', $registerFormId)->first();
        $address = address::where('address_id', $registerFormId)->first();
        $payment = payment_form::where('payment_id', $registerFormId)->first(); // Correct usage
        $previousSchool = previous_school::where('school_id', $registerFormId)->first();
        $requiredDocs = required_docs::where('required_id', $registerFormId)->first();
        $assign = assign::where('class_id', $registerFormId)->first();
    
        $allCompleted = true;
    
        $paymentStatus = $payment ? $payment->status : null;
        if ($paymentStatus !== 'approved') {
            $allCompleted = false;
        }
    
        $detailsStatus = $studentDetail ? $studentDetail->status : null;
        if ($detailsStatus !== 'approved') {
            $allCompleted = false;
        }
    
        $addressStatus = $address ? $address->status : null;
        if ($addressStatus !== 'approved') {
            $allCompleted = false;
        }
    
        $previousStatus = $previousSchool ? $previousSchool->status : null;
        if ($previousStatus !== 'approved') {
            $allCompleted = false;
        }
    
        $requiredStatus = $requiredDocs ? $requiredDocs->status : null;
        if ($requiredStatus !== 'approved') {
            $allCompleted = false;
        }
    
        $assignStatus = $assign ? $assign->status : null;
        if ($assignStatus !== 'assigned') {
            $allCompleted = false;
        }
    
        $address_id = $address ? $address->address_id : null;
        $details_id = $studentDetail ? $studentDetail->details_id : null;
        $school_id  = $previousSchool ? $previousSchool->school_id : null;
        $required_id = $requiredDocs ? $requiredDocs->required_id : null;
        $payment_id = $payment ? $payment->payment_id : null; 
        $class_id = $assign ? $assign->class_id : null;
    
        return view('enrollmentstep', compact(
            'allCompleted', 
            'detailsStatus', 
            'addressStatus', 
            'previousStatus', 
            'paymentStatus', 
            'requiredStatus', 
            'assignStatus', 
            'registerFormId', 
            'registerForm',  
            'address_id',
            'details_id',
            'school_id',
            'required_id',
            'payment_id',
            'class_id'
        ));
    }

public function approvePayment($id)
{
    $paymentForm = payment_form::find($id); 

    if (!$paymentForm) {
        return redirect('/cashierstudentfee')->with('error', 'Payment not found.');
    }

    if ($paymentForm->status === 'pending') {
        $paymentForm->status = 'approved';
        $paymentForm->save();
    }

    $user = Auth::user();
    if ($user instanceof User) {
        $user->save();
        FacadesMail::to($user->email)->send(new ApprovePayment($user->toArray()));
    }

    return redirect('/cashierstudentfee')->with('success', 'Payment approved successfully.');
}

    //principal


    public function classloadpost(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'grade' => 'required',
            'adviser' => 'required|exists:teachers,id',
            'section' => 'required',
            'edpcode' => 'required',
            'subject' => 'required',
            'room' => 'required',
            'description' => 'required',
            'type' => 'nullable|string',
            'unit' => 'required|integer|max:3',
            'startTime' => 'required|date_format:H:i',
            'endTime' => 'required|date_format:H:i',
            'days' => 'required',
        ]);
    
        $teacher = Teacher::find($validatedData['adviser']);
        if (!$teacher) {
            return redirect('/principalclassload')->withErrors(['error' => 'Selected teacher not found.'])->withInput();
        }
        $teacherName = trim($teacher->name);
    
        // Check existing schedules for the specified section
        $existingSchedules = classes::where('grade', $validatedData['grade'])
            ->where('section', strtoupper($validatedData['section'])) // Ensure case consistency
            ->count();
    
        // Handle warnings and maximum schedule checks
        if ($existingSchedules >= 10) {
            return redirect('/principalclassload')->withErrors(['error' => 'Maximum of 10 schedules reached for this section.'])->withInput()->with([
                'sections' => section::all(),
                'teachers' => teacher::all(),
                'selectedGrade' => $validatedData['grade'],
                'selectedSection' => strtoupper($validatedData['section']),
                'selectedSubject' => strtoupper($validatedData['subject']),
                'selectedAdviser' => $validatedData['adviser'],
            ]);
        }
    
        if ($existingSchedules == 10) {
            return redirect('/principalclassload')->with('warning', 'Warning: The section has reached 10 schedules. Maximum is 10.')->withInput()->with([
                'sections' => section::all(),
                'teachers' => teacher::all(),
                'selectedGrade' => $validatedData['grade'],
                'selectedSection' => strtoupper($validatedData['section']),
                'selectedSubject' => strtoupper($validatedData['subject']),
                'selectedAdviser' => $validatedData['adviser'],
            ]);
        }
    
        // Prepare class entry data
        $classData = [
            'grade' => $validatedData['grade'],
            'adviser' => $teacherName,
            'section' => strtoupper($validatedData['section']),
            'edpcode' => strtoupper($validatedData['edpcode']),
            'subject' => strtoupper($validatedData['subject']),
            'room' => strtoupper($validatedData['room']),
            'description' => strtoupper($validatedData['description']),
            'type' => $validatedData['type'],
            'unit' => strtoupper($validatedData['unit']),
            'startTime' => $validatedData['startTime'], 
            'endTime' => $validatedData['endTime'],    
            'days' => strtoupper($validatedData['days']),
            'status' => 'not assigned',
        ];
    
        // Check for conflicts: any teacher scheduled at the same time on the same day
        $timeConflict = classes::where('grade', $classData['grade'])
            ->where('section', $classData['section'])
            ->where('days', $classData['days'])
            ->where(function ($query) use ($validatedData) {
                $query->where('startTime', '<', $validatedData['endTime'])
                      ->where('endTime', '>', $validatedData['startTime']);
            })
            ->exists();
    
        // Handle conflict for any teacher at the same time
        if ($timeConflict) {
            return redirect('/principalclassload')->withErrors(['error' => 'Conflict detected: Another class is scheduled at this time on the same day.'])->withInput()->with([
                'sections' => section::all(),
                'teachers' => teacher::all(),
                'selectedGrade' => $validatedData['grade'],
                'selectedSection' => strtoupper($validatedData['section']),
                'selectedSubject' => strtoupper($validatedData['subject']),
                'selectedAdviser' => $validatedData['adviser'],
            ]);
        }
    
        // Create the class entry
        classes::create($classData);
    
        return redirect('/principalclassload')->with([
            'sections' => section::all(),
            'teachers' => teacher::all(),
            'selectedGrade' => $validatedData['grade'],
            'selectedSection' => strtoupper($validatedData['section']),
            'selectedSubject' => strtoupper($validatedData['subject']),
            'selectedAdviser' => $validatedData['adviser'],
        ])->with('success', 'Classload added successfully.');
    }

        public function principalclassload(Request $request)
    {
        // Get selected values from the request
        $selectedGrade = $request->input('grade', session('selectedGrade'));
        $selectedSection = $request->input('section', session('selectedSection'));
        $selectedSubject = $request->input('subject', session('selectedSubject'));
        
        // Get all classes
        $class = classes::all();
        
        // Fetch all teachers
        $teachers = teacher::all();

        // Extract unique subjects from teachers
        $subjects = [];
        foreach ($teachers as $teacher) {
            $teacherSubjects = explode(',', $teacher->subject); // Assuming subjects are comma-separated
            foreach ($teacherSubjects as $subject) {
                $subjects[trim($subject)] = true; 
            }
        }
            $subjects = array_keys($subjects);
        $filteredTeachers = teacher::where('grade', $selectedGrade)
        ->where('subject', 'LIKE', '%' . $selectedSubject . '%')
        ->get();
        
        $schedules = []; 

        if ($selectedGrade && $selectedSection) {
            $schedules = classes::where('grade', $selectedGrade)
                                ->where('section', $selectedSection)
                                ->get();
        }
        
        return view('principalclassload', compact('class', 'subjects', 'filteredTeachers', 'schedules', 'selectedGrade', 'selectedSection', 'selectedSubject'));
    }

public function principaleditassessmentpost(Request $request)
{
    $request->validate([
        'school_year' => 'required|string|max:255',
        'grade_level' => 'required|string|max:255',
        'assessment_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'assessment_date' => 'required|date',
        'assessment_time' => 'required|date_format:H:i',
        'assessment_fee' => 'required|numeric|min:0',
    ]);

    $assessment = Assessment::findOrFail($request->id);

    $assessment->update([
        'school_year' => $request->school_year,
        'grade_level' => $request->grade_level,
        'assessment_name' => $request->assessment_name,
        'description' => $request->description,
        'assessment_date' => $request->assessment_date,
        'assessment_time' => $request->assessment_time,
        'assessment_fee' => $request->assessment_fee,
        'status' => 'published', 
    ]);

    FacadesMail::to('accounting@example.com')->send(new EditAssessment($assessment));

    return redirect()->route('/principalassessment', $assessment->id) 
                     ->with('success', 'Assessment updated and email sent successfully!');
}


public function updateQuarters(Request $request)
{
    // Validate request
    $request->validate([
        '1st_quarter_enabled' => 'boolean',
        '2nd_quarter_enabled' => 'boolean',
        '3rd_quarter_enabled' => 'boolean',
        '4th_quarter_enabled' => 'boolean',
        'quarter_status' => 'required|in:active,inactive',
    ]);

    // Fetch existing settings or create a new one
    $settings = QuarterSettings::first();
    if ($settings) {
        $settings->first_quarter_enabled = $request->has('1st_quarter_enabled'); // true if checked
        $settings->second_quarter_enabled = $request->has('2nd_quarter_enabled');
        $settings->third_quarter_enabled = $request->has('3rd_quarter_enabled');
        $settings->fourth_quarter_enabled = $request->has('4th_quarter_enabled');
        
        // Update the overall quarter status
        $settings->quarter_status = $request->input('quarter_status');
        
        $settings->save();
    } else {
        QuarterSettings::create([
            'first_quarter_enabled' => $request->has('1st_quarter_enabled'),
            'second_quarter_enabled' => $request->has('2nd_quarter_enabled'),
            'third_quarter_enabled' => $request->has('3rd_quarter_enabled'),
            'fourth_quarter_enabled' => $request->has('4th_quarter_enabled'),
            'quarter_status' => $request->input('quarter_status'),
        ]);
    }

    return redirect()->back()->with('success', 'Quarter settings updated successfully.');
}

public function showEvaluateGrades()
{
    $quarterSettings = QuarterSettings::first();

     if (!$quarterSettings) {
        $quarterSettings = new QuarterSettings();
        $quarterSettings->first_quarter_enabled = false;
        $quarterSettings->second_quarter_enabled = false;
        $quarterSettings->third_quarter_enabled = false;
        $quarterSettings->fourth_quarter_enabled = false;
        $quarterSettings->quarter_status = 'inactive'; // Default status
    }


    $quartersEnabled = [
        '1st_quarter' => $quarterSettings->first_quarter_enabled,
        '2nd_quarter' => $quarterSettings->second_quarter_enabled,
        '3rd_quarter' => $quarterSettings->third_quarter_enabled,
        '4th_quarter' => $quarterSettings->fourth_quarter_enabled,
    ];

   
    $quartersStatus = [
        '1st_quarter' => $quarterSettings->quarter_status,
        '2nd_quarter' => $quarterSettings->quarter_status,
        '3rd_quarter' => $quarterSettings->quarter_status,
        '4th_quarter' => $quarterSettings->quarter_status,
    ];

    // Fetch other necessary data
    $assigns = Assign::all();
    $grades = Grade::all();

    // Return the principal interface view with all necessary variables
    return view('submittedgrades', [
        'quartersEnabled' => $quartersEnabled,
        'quartersStatus' => $quartersStatus,
        'quarterSettings' => $quarterSettings,
        'assigns' => $assigns,
        'grades' => $grades,
    ]);
}
    public function update_class(Request $request, $id)
    {

        $class = classes::findOrFail($id);
        return view('update_class', compact('class'));
    }

    public function updateClass(Request $request, $id)
    {
        // Fetch the class or fail
        $classes = classes::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'grade' => 'required',
            'section' => 'required',
            'edpcode' => 'required',
            'subject' => 'required',
            'room' => 'required',
            'description' => 'required',
            'type' => 'nullable|string',
            'unit' => 'required|integer|max:3', // Ensure unit is an integer and within limit
            'time' => 'required',
            'days' => 'required',
        ]);

        // Update the class with the validated data
        $classes->update($validatedData);

        // Redirect with a success message
        return redirect('/principalclassload')->with('success', 'Class load updated successfully.');
    }

    public function assigning(Request $request)
    {
        $request->validate([
            'selected_classes' => 'required|array',
            'selected_classes.*' => 'string',
            'grade' => 'required|string',
            'payment_id' => 'required|integer'
        ]);
    
        $anyAssigned = false;
    
        foreach ($request->selected_classes as $classEdpCode) {
            $class = Classes::where('edpcode', $classEdpCode)->first();
    
            if ($class) {
                $existingAssignment = Assign::where('edpcode', $class->edpcode)
                    ->where('class_id', $request->input('payment_id'))
                    ->first();
    
                if (!$existingAssignment) {
                    $assignment = Assign::create([
                        'grade' => $request->input('grade'),
                        'adviser' => $class->adviser,
                        'section' => $class->section,
                        'edpcode' => $class->edpcode,
                        'room' => $class->room,
                        'subject' => $class->subject,
                        'description' => $class->description,
                        'type' => $class->type ?? null,
                        'unit' => $class->unit,
                        'startTime' => $class->startTime,
                        'endTime' => $class->endTime,
                        'days' => $class->days,
                        'class_id' => $request->input('payment_id'),
                        'status' => 'assigned',
                    ]);
    
                    // Log the created assignment
                    Log::info('Assignment Created:', $assignment->toArray());
    
                    $class->assign_id = $request->input('payment_id');
                    $class->status = 'assigned';
                    $class->save();
    
                    $anyAssigned = true;
    
                }
            }
        }
    
        if ($anyAssigned) {
            return redirect('/sectioning')->with('success', 'Classload assigned successfully.');
        } else {
            return redirect('/sectioning')->with('error', 'No classes were assigned or duplicate entries were avoided.');
        }
    }

    public function sectionpost(Request $request)
    {
        $request->validate([
            'selected_classes' => 'required|array',
            'selected_classes.*' => 'string',
            'grade' => 'required|string',
            'payment_id' => 'required|integer'
        ]);
    
        $paymentId = $request->input('payment_id');
        Log::info('Submitted payment_id:', ['payment_id' => $paymentId]);
    
        // Check if the payment_id exists in the payment_form table
        $paymentExists = payment_form::where('payment_id', $paymentId)->exists();
    
        if (!$paymentExists) {
            return redirect('/sectioning')->with('error', 'Invalid payment ID. Please check and try again.');
        }
    
        // Use the payment_id as both class_id and assign_id
        $paymentFormId = $paymentId; 
    
        $anyAssigned = false;
    
        foreach ($request->selected_classes as $classEdpCode) {
            $class = Classes::where('edpcode', $classEdpCode)->first();
    
            if ($class) {
                // Check for existing assignments using paymentFormId
                $existingAssignment = Assign::where('edpcode', $class->edpcode)
                    ->where('class_id', $paymentFormId) // Using paymentFormId as class_id
                    ->first();
    
                if (!$existingAssignment) {
                    // Create a new assignment using paymentFormId for class_id and assign_id
                    $assignment = Assign::create([
                        'grade' => $request->input('grade'),
                        'adviser' => $class->adviser,
                        'section' => $class->section,
                        'edpcode' => $class->edpcode,
                        'room' => $class->room,
                        'subject' => $class->subject,
                        'description' => $class->description,
                        'type' => $class->type ?? null,
                        'unit' => $class->unit,
                        'startTime' => $class->startTime,
                        'endTime' => $class->endTime,
                        'days' => $class->days,
                        'class_id' => $paymentFormId, // Use payment_id as class_id
                        'status' => 'assigned',
                        'assign_id' => $paymentFormId, // Use payment_id as assign_id
                    ]);
    
                    Log::info('Assignment Created:', $assignment->toArray());
    
                    // Update class status
                    $class->assign_id = $paymentFormId; // Use payment_id as assign_id in class
                    $class->status = 'assigned';
                    $class->save();
    
                    $anyAssigned = true;
                }
            }
        }
    
        if ($anyAssigned) {
            return redirect('/sectioning')->with('success', 'Classload assigned successfully.');
        } else {
            return redirect('/sectioning')->with('error', 'No classes were assigned or duplicate entries were avoided.');
        }
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
        ]);

        $userId = Auth::id();
        $profile = register_form::find($userId);
        $users = User::find($userId);
        $studentdetails = studentdetails::find($userId);

        if (!$profile) {
            return response()->json(['error' => 'Profile not found.'], 404);
        }

        // Update the profile in the database
        $profile->update($validatedData);
        $users->update($validatedData);
        $studentdetails->update($validatedData);

        Log::info('Profile updated:', $validatedData);

        return response()->json(['success' => 'Profile updated successfully.']);
    }

    public function gradesubmitpost(Request $request)
{
    try {
        // Validate the incoming request data
        $validateData = $request->validate([
            'edp_code' => 'required',
            'subject' => 'required',
            'grade_id' => 'required|integer',
            'fullname' => 'required',
            'section' => 'required',
            '1st_quarter' => 'nullable|numeric|min:0|max:100',
            '2nd_quarter' => 'nullable|numeric|min:0|max:100',
            '3rd_quarter' => 'nullable|numeric|min:0|max:100',
            '4th_quarter' => 'nullable|numeric|min:0|max:100',
            'overall_grade' => 'required|numeric|min:0|max:100'
        ]);

        // Prepare the data for insertion/updating
        $gradesData = [
            'fullname' => $validateData['fullname'],
            'section' => $validateData['section'],
            'edp_code' => $validateData['edp_code'],
            'subject' => $validateData['subject'],
            'grade_id' => $validateData['grade_id'],
            '1st_quarter' => $validateData['1st_quarter'] ?? null,
            '2nd_quarter' => $validateData['2nd_quarter'] ?? null,
            '3rd_quarter' => $validateData['3rd_quarter'] ?? null,
            '4th_quarter' => $validateData['4th_quarter'] ?? null,
            'overall_grade' => $validateData['overall_grade'],
            'status' => 'pending'
        ];

        // Use updateOrCreate
        Grade::updateOrCreate(
            [
                'edp_code' => $validateData['edp_code'], // Unique identifier
                'subject' => $validateData['subject'],
                'grade_id' => $validateData['grade_id'],
            ],
            $gradesData
        );

        return redirect()->back()->with('success', 'Student Grade submitted successfully.');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->withInput()->withErrors(['Failed to submit grade: ' . $e->getMessage()]);
    }
}
    public function publish($id)
    {
        $grades = grade::findOrFail($id);


        if ($grades->status === 'pending') {

            $grades->status = 'approved';
            $grades->save();

            return redirect('submittedgrades')->with('success', 'Grade status updated to approved.');
        }

        return redirect('submittedgrades')->with('error', 'Grade status cannot be updated.');
    }

    public function teachercorevaluepost(Request $request)
    {
        $request->validate([
            'student_ids.*' => 'required|exists:grades,id', // Ensure each student ID exists
            'respect.*' => 'required|string',
            'excellence.*' => 'required|string',
            'teamwork.*' => 'required|string',
            'innovation.*' => 'required|string',
            'sustainability.*' => 'required|string',
            'fullname' => 'required|string',
            'section' => 'required|string',
        ]);
    
        DB::beginTransaction();
        try {
            foreach ($request->student_ids as $index => $studentId) {
                corevalues::create([
                    'student_id' => $studentId,
                    'respect' => $request->respect[$index],
                    'excellence' => $request->excellence[$index],
                    'teamwork' => $request->teamwork[$index],
                    'innovation' => $request->innovation[$index],
                    'sustainability' => $request->sustainability[$index],
                    'fullname' => $request->fullname, 
                    'section' => $request->section, 
                ]);
            }
                DB::commit();
    
            return redirect()->back()->with('success', 'Core values saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Error saving core values: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'An error occurred while saving core values.');
        }
    }

    public function studentapplicant(Request $request)
    {

        $request->validate([
            'students' => 'required|array',
            'students.*' => 'exists:register_form,id',
        ]);

        foreach ($request->students as $studentId) {

            $student = register_form::find($studentId);

            $user = User::create([
                'firstname' => $student->firstname,
                'lastname' => $student->lastname,
                'middlename' => $student->middlename,
                'suffix' => $student->suffix,
                'role' => 'NewstudentFill',
                'email' => $student->email,
                'password' => $student->password,
            ]);

            $student->status = 'approved';
            $student->user_id = $user->id;
            $student->save();


            FacadesMail::to($user->email)->send(new ApproveStudent($user));
        }

        return redirect()->back()->with('success', 'Selected students have been approved and notified.');
    }

    public function cashierstudentfeepost(Request $request)
    {
        $request->validate([
            'payments' => 'required|array',
            'payments.*' => 'exists:payment_form,id', 
        ]);
    
        $paymentIds = $request->input('payments');
        $approvedPayments = [];
    
        foreach ($paymentIds as $id) {
            $paymentForm = payment_form::where('id', $id)->first();
    
            if ($paymentForm && $paymentForm->status === 'pending') {
                $paymentForm->status = 'approved';
                $paymentForm->save();
    
                $approvedPayments[] = $id;
            }
        }
    
        if (!empty($approvedPayments)) {
            $user = Auth::user();
            if ($user instanceof User) {
                $user->save();
    
                FacadesMail::to($user->email)->send(new ApprovePayment($user->toArray()));
            }
        }
    
        return redirect()->back()->with('success', 'Selected payments have been approved and notified.');
    }

    public function showTeachers()
    {
        // Fetch users with the role 'teacher'
        $teachers = User::where('role', 'teacher')->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname),
                'assigned' => Teacher::where('name', trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname))->exists(),
            ];
        });

        return view('principalteacher', compact('teachers'));
    }
    
    public function teachersubjectpost(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|exists:users,id', 
        'grade' => 'required|string',
        'subject' => 'required|array', // Change to array to accept multiple subjects
        'subject.*' => 'string', // Validate each subject as a string
    ]);

    // Fetch the teacher by ID from the User table
    $user = User::find($validatedData['name']);

    // Check if the teacher's record already exists
    $teacherRecord = Teacher::where('name', trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname))
                            ->where('grade', $validatedData['grade'])
                            ->first();

    if ($teacherRecord) {
        // Update existing record with new subjects
        $existingSubjects = explode(', ', $teacherRecord->subject);
        $newSubjects = $validatedData['subject'];
        $allSubjects = array_unique(array_merge($existingSubjects, $newSubjects)); // Merge and remove duplicates

        $teacherRecord->subject = implode(', ', $allSubjects); // Concatenate subjects
        $teacherRecord->updated_at = now();
        $teacherRecord->save();
    } else {
        // Create a new record
        teacher::create([
            'name' => trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname),
            'subject' => implode(', ', $validatedData['subject']), // Store subjects as a single string
            'grade' => $validatedData['grade'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Fetch teachers again to pass back to the view
    $teachers = User::where('role', 'teacher')->get()->map(function ($user) {
        return [
            'id' => $user->id,
            'name' => trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname),
            'assigned' => teacher::where('name', trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname))->exists(),
        ];
    });

    return redirect()->route('principalteacher')->with([
        'teachers' => $teachers,
        'success' => 'Teacher assigned successfully.',
    ]);
}

    public function createsectionpost(Request $request)
    {
        $validatedData = $request->validate([
            'section' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
        ]);
    
        // Check for duplicate section regardless of grade
        $existingSection = section::where('section', $validatedData['section'])->first();
    
        if ($existingSection) {
            // Redirect back with an error message
            return redirect()->back()->withErrors(['section' => 'This section already exists.']);
        }
    
        // Create a new section schedule
        $section = section::create([
            'section' => $validatedData['section'],
            'grade' => $validatedData['grade'],
        ]);
    
        // Redirect to the principalclassload with the created section data
        return redirect()->route('principalclassload', [
            'grade' => $section->grade,
            'section' => $section->section
        ])->with('success', 'Section created successfully.');
    }


    public function assessmentpost(Request $request)
    {
        $validatedData = $request->validate([
            'school_year' => 'required|string',
            'grade_level' => 'required|string',
            'assessment_name' => 'required|string|max:255',
            'description' => 'required|string',
            'assessment_date' => 'required|date',
            'assessment_time' => 'required|date_format:H:i', // Validate as 24-hour format
            'assessment_fee' => 'required|numeric|min:0',
        ]);
    
        $assessment = new Assessment(); 
        $assessment->school_year = $validatedData['school_year'];
        $assessment->grade_level = $validatedData['grade_level'];
        $assessment->assessment_name = $validatedData['assessment_name'];
        $assessment->description = $validatedData['description'];
        $assessment->assessment_date = $validatedData['assessment_date'];
    
        $assessment->assessment_time = \Carbon\Carbon::createFromFormat('H:i', $validatedData['assessment_time'])->format('h:i A');
    
        $assessment->assessment_fee = $validatedData['assessment_fee'];
        
        $assessment->status = 'pending';
    
        $assessment->save();
    
        FacadesMail::to('principal@example.com')->send(new AssessmentCreated($assessment));

        return redirect()->back()->with('success', 'Assessment created successfully!');
    }

    public function updateQuarter(Request $request, $assignId, $quarter, $status)
    {
        // Find the grade entry
        $grade = grade::where('id', $assignId)->first();

        if ($grade) {
            // Update the corresponding quarter status
            switch ($quarter) {
                case '1st':
                    $grade->first_quarter_enabled = (bool)$status;
                    break;
                case '2nd':
                    $grade->second_quarter_enabled = (bool)$status;
                    break;
                case '3rd':
                    $grade->third_quarter_enabled = (bool)$status;
                    break;
                case '4th':
                    $grade->fourth_quarter_enabled = (bool)$status;
                    break;
            }

            // Save the changes
            $grade->save();

            return response()->json(['message' => 'Quarter status updated successfully.']);
        }

        return response()->json(['message' => 'Grade not found.'], 404);
    }


    public function newstudentpost(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'suffix' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'nationality' => 'required',
            'gender' => 'required',
            'civilstatus' => 'required',
            'birthdate' => 'required|date',
            'birthplace' => 'required',
            'religion' => 'required',
            'mother_name' => 'required',
            'mother_occupation' => 'required',
            'mother_contact' => 'required',
            'father_name' => 'required',
            'father_occupation' => 'required',
            'father_contact' => 'required',
            'guardian_name' => 'required',
            'guardian_occupation' => 'required',
            'guardian_contact' => 'required',
        ]);
    
        DB::beginTransaction();
    
        try {
            // Create User with hashed password
            $user = User::create([
                'firstname' => $validatedData['firstname'],
                'middlename' => $validatedData['middlename'],
                'lastname' => $validatedData['lastname'],
                'suffix' => $validatedData['suffix'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']), // Hash the password
                'role' => 'NewStudent',
            ]);
    
            // Create Register Form without hashing the password
            $registerForm = register_form::create([
                'firstname' => $validatedData['firstname'],
                'middlename' => $validatedData['middlename'],
                'lastname' => $validatedData['lastname'],
                'suffix' => $validatedData['suffix'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'], // Store plain password
                'status' => register_form::STATUS_APPROVED, // Set status to approved
                'user_id' => $user->id, 
            ]);
    
            // Create Student Details
        studentdetails::create([
            'details_id' => $registerForm->id, 
            'firstname' => $validatedData['firstname'], // Ensure this is included
            'middlename' => $validatedData['middlename'], // Include if needed
            'lastname' => $validatedData['lastname'], // Include if needed
            'suffix' => $validatedData['suffix'], // Include if needed
            'nationality' => $validatedData['nationality'],
            'gender' => $validatedData['gender'],
            'civilstatus' => $validatedData['civilstatus'],
            'birthdate' => $validatedData['birthdate'],
            'birthplace' => $validatedData['birthplace'],
            'religion' => $validatedData['religion'],
            'mother_name' => $validatedData['mother_name'],
            'mother_occupation' => $validatedData['mother_occupation'],
            'mother_contact' => $validatedData['mother_contact'],
            'father_name' => $validatedData['father_name'],
            'father_occupation' => $validatedData['father_occupation'],
            'father_contact' => $validatedData['father_contact'],
            'guardian_name' => $validatedData['guardian_name'],
            'guardian_occupation' => $validatedData['guardian_occupation'],
            'guardian_contact' => $validatedData['guardian_contact'],
            'status' => studentdetails::STATUS_APPROVED, // Set status to approved
        ]);
    
            DB::commit();
    
            return response()->json(['message' => 'Student registered successfully!'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration failed: '.$e->getMessage());
            return response()->json(['error' => 'Registration failed, please try again.'], 500);
        }
    }


    public function oldstudentpost(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'suffix' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'nationality' => 'required',
            'gender' => 'required',
            'civilstatus' => 'required',
            'birthdate' => 'required|date',
            'birthplace' => 'required',
            'religion' => 'required',
            'mother_name' => 'required',
            'mother_occupation' => 'required',
            'mother_contact' => 'required',
            'father_name' => 'required',
            'father_occupation' => 'required',
            'father_contact' => 'required',
            'guardian_name' => 'required',
            'guardian_occupation' => 'required',
            'guardian_contact' => 'required',
        ]);
    
        DB::beginTransaction();
    
        try {
            $user = User::create([
                'firstname' => $validatedData['firstname'],
                'middlename' => $validatedData['middlename'],
                'lastname' => $validatedData['lastname'],
                'suffix' => $validatedData['suffix'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']), 
                'role' => 'OldStudent',
            ]);

            $registerForm = register_form::create([
                'firstname' => $validatedData['firstname'],
                'middlename' => $validatedData['middlename'],
                'lastname' => $validatedData['lastname'],
                'suffix' => $validatedData['suffix'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'], 
                'status' => register_form::STATUS_APPROVED, 
                'user_id' => $user->id, 
            ]);

            session(['register_form_id' => $registerForm->id]);
    
        studentdetails::create([
            'details_id' => $registerForm->id, 
            'firstname' => $validatedData['firstname'], // Ensure this is included
            'middlename' => $validatedData['middlename'], // Include if needed
            'lastname' => $validatedData['lastname'], // Include if needed
            'suffix' => $validatedData['suffix'], // Include if needed
            'nationality' => $validatedData['nationality'],
            'gender' => $validatedData['gender'],
            'civilstatus' => $validatedData['civilstatus'],
            'birthdate' => $validatedData['birthdate'],
            'birthplace' => $validatedData['birthplace'],
            'religion' => $validatedData['religion'],
            'mother_name' => $validatedData['mother_name'],
            'mother_occupation' => $validatedData['mother_occupation'],
            'mother_contact' => $validatedData['mother_contact'],
            'father_name' => $validatedData['father_name'],
            'father_occupation' => $validatedData['father_occupation'],
            'father_contact' => $validatedData['father_contact'],
            'guardian_name' => $validatedData['guardian_name'],
            'guardian_occupation' => $validatedData['guardian_occupation'],
            'guardian_contact' => $validatedData['guardian_contact'],
            'status' => studentdetails::STATUS_PENDING, 
        ]);
    
            DB::commit();
    
            return redirect('oldstudentaddress');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration failed: '.$e->getMessage());
            return response()->json(['error' => 'Registration failed, please try again.'], 500);
        }
    }

    public function oldstudentaddresspost(Request $request)
    {

        $registerFormId = session('register_form_id'); 

        if (!$registerFormId) {
            return response()->json(['error' => 'Register form ID not found.'], 404);
        }

        $registerForm = \App\Models\register_form::find($registerFormId);

        if (!$registerForm) {
            return response()->json(['error' => 'Register form not found.'], 404);
        }

        $validatedData = $request->validate([
            'zipcode' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'streetaddress' => 'required',
            
        ]);
    

        $validatedData['address_id'] = $registerForm->id; 
        $validatedData['status'] = address::STATUS_PENDING;

        address::create($validatedData); 

        return redirect('oldstudentprevious');
    }

    public function oldstudentpreviouspost(Request $request)
    {
        $registerFormId = session('register_form_id'); 

        if (!$registerFormId) {
            return response()->json(['error' => 'Register form ID not found.'], 404);
        }

        $registerForm = \App\Models\register_form::find($registerFormId);

        if (!$registerForm) {
            return response()->json(['error' => 'Register form not found.'], 404);
        }

        $validatedData = $request->validate([
            'second_school_name' => 'required',
            'second_last_year_level' => 'required',
            'second_school_year_from' => 'required|digits:4|integer|min:1900|max:2100',
            'second_school_year_to' => 'required|digits:4|integer|min:1900|max:2100|gte:second_school_year_from',
            'second_school_type' => 'required',

            'primary_school_name' => 'required',
            'primary_last_year_level' => 'required',
            'primary_school_year_from' => 'required|digits:4|integer|min:1900|max:2100',
            'primary_school_year_to' => 'required|digits:4|integer|min:1900|max:2100|gte:primary_school_year_from',
            'primary_school_type' => 'required',
        ]);

        $validatedData['school_id'] = $registerForm->id; 
        $validatedData['status'] = previous_school::STATUS_PENDING;

        previous_school::create($validatedData); 

        return redirect('admin');
    }

    public function oldstudentupdatedocumentspost(Request $request)
    {
        $validateData = $request->validate([
            'type' => 'required|array',
            'type.*' => 'string|distinct',
            'documents' => 'required|array',
            'documents.*' => 'file|max:10240|mimes:jpg,png,pdf',
            'required_id' => 'required|exists:register_form,id',
        ]);
    
        $uploadedTypes = [];
        $filesUploaded = [];
    
        foreach ($request->file('documents') as $index => $file) {
            $docType = $validateData['type'][$index];
    
            if (in_array($docType, $uploadedTypes)) {
                continue;
            }
    
            $filePath = $file->store('documents', 'public');
    
            required_docs::create([
                'type' => $docType,
                'documents' => $filePath,
                'required_id' => $validateData['required_id'],
                'status' => 'approved'
            ]);
    
            $uploadedTypes[] = $docType;
            $filesUploaded[] = $filePath;
        }
    
        $user = Auth::user();
        $registerForm = register_form::where('user_id', $user->id)->first();
    
        if (!$registerForm) {
            return redirect('/oldstudentenrollment')->with('error', 'Register form not found.');
        }
    
        return redirect()->route('oldstudentenrollment')
                         ->with('success', 'Required Documents submitted successfully.');
    }

    public function oldstudentpaymentpost(Request $request)
    {
        $registerFormId = session('register_form_id'); 

        if (!$registerFormId) {
            return response()->json(['error' => 'Register form ID not found.'], 404);
        }
    
        $registerForm = \App\Models\register_form::find($registerFormId);
    
        if (!$registerForm) {
            return response()->json(['error' => 'Register form not found.'], 404);
        }

        $request->validate([
            'payment-proof' => 'required|image|mimes:jpg,jpeg,png,bmp|max:2048',
            'level' => 'required|string',
            'payment-details' => 'required|string|max:1000',
        ]);

        if ($request->hasFile('payment-proof')) {
            $file = $request->file('payment-proof');
            $filePath = $file->store('payment_proofs', 'public');

            $payment = new payment_form();
            $payment->fee_type = 'Enrollment Fee'; 
            $payment->amount = 500; 
            $payment->payment_proof = $filePath;
            $payment->payment_details = $request->input('payment-details');
            $payment->payment_id = $registerFormId; 
            $payment->level = $request->input('level');
            $payment->status = 'pending'; 
            $payment->save();
        }
        return redirect('oldstudentenrollment')->with('success', 'Payment submitted successfully. Please wait for cashier approval');
    }


    public function oldstudentupdatedetailspost(Request $request)
    {
        $validateData = $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'suffix' => 'required',
            'nationality' => 'required',
            'gender' => 'required',
            'civilstatus' => 'required',
            'birthdate' => 'required',
            'birthplace' => 'required',
            'religion' => 'required',
            'mother_name' => 'required',
            'mother_occupation' => 'required',
            'mother_contact' => 'required',
            'father_name' => 'required',
            'father_occupation' => 'required',
            'father_contact' => 'required',
            'guardian_name' => 'required',
            'guardian_occupation' => 'required',
            'guardian_contact' => 'required',
        ]);
    
        $userId = Auth::user()->id;
    
        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();
    
        if (!$registerForm) {
            return redirect()->route('oldstudentenrollment')->withErrors('No registration form found.');
        }
    
        $studentDetail = \App\Models\StudentDetails::where('details_id', $registerForm->id)->first();
    
        if ($studentDetail) {
    
            $studentDetail->update($validateData);
            
            $studentDetail->status = 'approved';
            $studentDetail->save();
    
            return redirect()->route('oldstudentenrollment')->with('success', 'Student details updated successfully.');
        } else {
            return redirect()->route('oldstudentenrollment')->withErrors('Student details not found.');
        }
    }
    public function oldstudentupdateaddresspost(Request $request)
    {
        $validateData = $request->validate([
            'zipcode' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'streetaddress' => 'required',
            
        ]);
        $userId = Auth::user()->id;

        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();

        $address = \App\Models\address::where('address_id', $registerForm->id)->first();

        if ($address) {
            $address->update($validateData);

            $address->status = 'approved';
            $address->save();

            return redirect('oldstudentenrollment')->with('success', 'Address details updated successfully.');
        } else {
            return redirect()->route('oldstudentenrollment')->withErrors('Address details not found.');
        }
    }

    public function oldstudentupdatepreviouspost(Request $request)
    {
        $validateData = $request->validate([
            'second_school_name' => 'required',
            'second_last_year_level' => 'required',
            'second_school_year_from' => 'required',
            'second_school_year_to' => 'required',
            'second_school_type' => 'required',

            'primary_school_name' => 'required',
            'primary_last_year_level' => 'required',
            'primary_school_year_from' => 'required',
            'primary_school_year_to' => 'required',
            'primary_school_type' => 'required',

           
        ]);

        $userId = Auth::user()->id;

        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();
    
        $previousSchool = \App\Models\previous_school::where('school_id', $registerForm->id)->first();
        
        if ($previousSchool) {

            $previousSchool->update($validateData);

            $previousSchool->status = 'approved';
            $previousSchool->save();

            return redirect('oldstudentenrollment')->with('success', 'Previous school details updated successfully.');
        } else {
            return redirect('oldstudentenrollment')->withErrors('Previous school details not found.');
        }
    }
}
