<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Models\assessment;
use App\Models\assign;
use App\Models\classes;
use App\Models\grade;
use App\Models\payment_form;
use App\Models\previous_school;
use App\Models\QuarterSettings;
use App\Models\register_form;
use App\Models\required_docs;
use App\Models\section;
use App\Models\studentdetails;
use App\Models\teacher;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Pagecontroller extends Controller
{

    public function user()
    {
        $users = User::all();
        return view('user', compact('users'));
    }
    public function login()
    {
        return view('login');
    }
    public function partialaccount()
    {
        sweetalert()->warning('This is your partial account so please fill up all the details asked.');
        return view('partialaccount');
    }
    public function register_consent()
    {
        sweetalert()->info('This is optional only but we need the consent of your parents first.');
        return view('register_consent');
    }

    public function studentdetails()
    {
        $details = studentdetails::all();

        return view('studentdetails', compact('details'));
    }

    public function address_contact()
    {
        return view('address_contact'); 
    }

    public function required_documents()
    {
        return view('required_documents');
    }

    public function previous_school()
    {
        $userId = Auth::user()->id; 
        return view('previous_school',compact('userId'));
    }

    public function payment_process()
    {
        return view('payment_process');
    }

    public function studentdashboard()
    {
        return view('studentdashboard');
    }
    public function studentclassload()
{
    $userId = Auth::id(); 

    $registerForm = \App\Models\register_form::where('user_id', $userId)->first();

    if (!$registerForm) {
        return redirect()->route('login')->withErrors('No registration form found.');
    }

    $assignedClasses = assign::where('class_id', $registerForm->id)->get();

    $student = $registerForm;

    $proof = payment_form::where('payment_id', $registerForm->id)->first();

    return view('studentclassload', [
        'assignedClasses' => $assignedClasses,
        'student' => $student,
        'proof' => $proof,
    ]);
}


public function oldstudentclassload()
{
    $userId = Auth::id(); // Get the authenticated user's ID

    // Find the register form associated with the authenticated user
    $registerForm = \App\Models\register_form::where('user_id', $userId)->first();

    if (!$registerForm) {
        return redirect()->route('login')->withErrors('No registration form found.');
    }

    // Use the registerForm ID to get assigned classes
    $assignedClasses = assign::where('class_id', $registerForm->id)->get();

    // The student variable now refers to the register form record
    $student = $registerForm;

    // Get payment proof associated with the register form
    $proof = payment_form::where('payment_id', $registerForm->id)->first();

    return view('oldstudentclassload', [
        'assignedClasses' => $assignedClasses,
        'student' => $student,
        'proof' => $proof,
    ]);
}







    public function studentprofile()
    {
        return view('studentprofile');
    }

    public function enrollmentStep()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();
    $registerForm = register_form::where('user_id', $user->id)->first(); 

    if (!$registerForm) {
        return redirect()->route('some.route')->with('error', 'No registration form found.');
    }

    $details = studentdetails::where('details_id', $registerForm->id)->first();
    $address = address::where('address_id', $registerForm->id)->first(); 
    $previousSchool = previous_school::where('school_id', $registerForm->id)->first();
    $requiredDocs = required_docs::where('required_id', $registerForm->id)->first();
    $payment = payment_form::where('payment_id', $registerForm->id)->first(); 
    $assignStatus = assign::where('class_id', $registerForm->id)->first(); 

    return view('enrollmentstep', compact('details', 'address', 'previousSchool', 'requiredDocs', 'payment', 'assignStatus'));
}

public function studentgrades()
{
    
    $userId = Auth::id();


    $grades = grade::where('grade_id', $userId) 
        ->get(['subject', 'edp_code', 'section', '1st_quarter', '2nd_quarter', '3rd_quarter', '4th_quarter', 'overall_grade']); 

    
    $gradesApproved = $grades->where('status', 'approved')->isNotEmpty();

    
    $approvedGrades = $grades->where('status', 'approved');

    return view('studentgrades', [
        'grades' => $approvedGrades, 
        'gradesApproved' => $gradesApproved,
    ]);
}

public function studentassessment(Request $request)
{
    $schoolYears = assessment::select('school_year')->distinct()->pluck('school_year');

    $user = Auth::user();
    $paymentId = $user ? $user->payment_id : null; // Safely get payment_id

    $userPayment = payment_form::where('payment_id', $paymentId)->first();
    $authGradeLevel = $userPayment ? strtolower(str_replace(' ', '', trim($userPayment->level))) : null;

    // Start with published assessments
    $assessments = assessment::where('status', 'Published');

    // Filter assessments by school year if selected
    if ($request->has('school_year') && $request->school_year !== '') {
        $assessments = $assessments->where('school_year', $request->school_year);
    }

    // Filter by the authenticated user's grade level (exact match)
    if ($authGradeLevel) {
        $assessments = $assessments->where('grade_level', '=', $authGradeLevel); // Exact match
    }

    // Get all assessments
    $assessments = $assessments->get();

    // Return the view with assessments, school years, and the user's grade level
    return view('studentassessment', compact('assessments', 'schoolYears', 'authGradeLevel'));
}

    //teacher 
    public function teacher()
    {
        return view('teacher');
    }
    public function teachernotification()
    {
        return view('teachernotification');
    }
    public function teacherprofile()
    {
        return view('teacherprofile');
    }
    public function teacherclassload()
    {
        $user = Auth::user(); 
        $fullName = trim("{$user->firstname} {$user->middlename} {$user->lastname}"); 

        $classes = assign::where('adviser', $fullName)->get(); 
    
        $proofs = payment_form::whereNotNull('level')->get(); 
    
        return view('teacherclassload', [
            'title' => 'Teacher Class Load',
            'classes' => $classes,
            'proofs' => $proofs 
        ]);
    }
    public function gradesubmit()
    {
        $userId = Auth::id();
        $assign = Assign::findOrFail($userId);
        $paymentForm = payment_form::where('payment_id', $assign->class_id)->first();
        $student = register_form::findOrFail($assign->class_id);
        
        // Fetch the full name of the student
        $fullName = "{$student->firstname} {$student->middlename} {$student->lastname}";
        
        // Fetch the grade if it exists
        $grade = grade::where('grade_id', $assign->id)->first();
        
        // Fetch the latest quarter settings
        $quartersEnabled = QuarterSettings::first();
        
        // Prepare the quarters enabled array
        $quartersEnabledArray = [
            '1st_quarter' => $quartersEnabled->first_quarter_enabled ?? false,
            '2nd_quarter' => $quartersEnabled->second_quarter_enabled ?? false,
            '3rd_quarter' => $quartersEnabled->third_quarter_enabled ?? false,
            '4th_quarter' => $quartersEnabled->fourth_quarter_enabled ?? false,
        ];
    
        // Prepare the quarters status array
        $quartersStatusArray = [
            '1st_quarter' => $quartersEnabled->first_quarter_status ?? 'inactive',
            '2nd_quarter' => $quartersEnabled->second_quarter_status ?? 'inactive',
            '3rd_quarter' => $quartersEnabled->third_quarter_status ?? 'inactive',
            '4th_quarter' => $quartersEnabled->fourth_quarter_status ?? 'inactive',
        ];
        
        return view('gradesubmit', [
            'assign' => $assign,
            'paymentForm' => $paymentForm,
            'fullName' => $fullName,
            'edpcode' => $assign->edpcode,
            'subject' => $assign->subject,
            'section' => $assign->section,
            'grade' => $grade,
            'quartersEnabled' => $quartersEnabledArray,
            'quartersStatus' => $quartersStatusArray, // Pass the status array to the view
        ]);
    }

    
    public function teacherattendance()
    {
        return view('teacherattendance');
    }

    public function teachercorevalue()
    {

        $user = Auth::user(); 
        $fullName = trim("{$user->firstname} {$user->middlename} {$user->lastname}"); 

        $classes = assign::where('adviser', $fullName)->get(); 
    
        $proofs = payment_form::whereNotNull('level')->get(); 
    
        return view('teachercorevalue', [
            'title' => 'Teacher Core Value Load',
            'classes' => $classes,
            'proofs' => $proofs 
        ]);
    }


    //principal
    public function principal()
    {
        return view('principal');
    }

    public function principalclassload()
    {
        $section = section::all();
        $class = classes::all();
        $teachers = teacher::all();
        return view('principalclassload', compact('class', 'teachers', 'section'));
    }

    public function submittedgrades(Request $request)
{
    // Fetch all assignments
    $assigns = assign::all();

    // Fetch all grades related to assignments
    $grades = grade::all();

    // Optional: Handle search functionality
    if ($request->has('search') && $request->search != '') {
        $searchTerm = $request->search;

        // Filter assignments based on search criteria
        $assigns = $assigns->filter(function ($assign) use ($searchTerm) {
            return stripos($assign->subject, $searchTerm) !== false ||
                   stripos($assign->adviser, $searchTerm) !== false ||
                   stripos($assign->section, $searchTerm) !== false;
        });
    }

    $data = [
        'title' => 'Submitted Grades',
        'assigns' => $assigns,
        'grades' => $grades
    ];

    return view('submittedgrades', $data);
}
    
    

    public function publishgrade()
    {
        return view('publishgrade');
    }

    //accounting
    public function accounting()
    {
        return view('accounting');
    }

    public function accountingassessment()
    {
        $assessments = assessment::all(); 
        return view('accountingassessment', compact('assessments'));
    }

    public function createassessment()
    {
        return view('createassessment');
    }
    public function accountingprofile()
    {
        return view('accountingprofile');
    }

    //record
    public function record()
    {
        // Count pending and approved accounts
        $pendingCount = register_form::where('status', 'pending')->count();
        $approvedCount = register_form::where('status', 'approved')->count();

        // Fetch student information
        $students = studentdetails::all(); // You can adjust this to filter or paginate if needed

        return view('record', compact('students', 'pendingCount', 'approvedCount'));
    }

    public function studententries()
    {

        $studentDetails = studentdetails::all();
        $previousSchools = previous_school::all();
        $addresses = address::all();
        $requiredDocs = required_docs::all();

        // Pass all datasets to the view
        return view('studententries', compact('studentDetails', 'previousSchools', 'addresses', 'requiredDocs'));
    }

    public function showdetails()
    {
        return view('showdetails');
    }

    public function studentapplicant()
    {
        $account = register_form::where('status', register_form::STATUS_PENDING)->get();
        return view('studentapplicant', compact('account'));
    }

    public function approvedaccount()
    {
        $account = register_form::where('status', 'approved')->get();
        return view('approvedaccount', compact('account'));
    }
    public function  recordapproval()
    {
        $account = register_form::all();
        return view(' recordapproval', compact('account'));
    }

    //cashier 
    public function cashier()
    {
        $pendingCount = payment_form::where('status', 'pending')->count();
        $approvedCount = payment_form::where('status', 'approved')->count();
        $students = studentdetails::all();
        return view('cashier', compact('students', 'pendingCount', 'approvedCount'));
    }
    public function cashieraddfee()
    {
        return view('cashieraddfee');
    }
    public function cashierstudentfee()
{
    // Fetch all students
    $students = register_form::all();
    
    // Fetch all payments
    $payments = payment_form::all();

    // Pass both students and payments to the view
    return view('cashierstudentfee', [
        'students' => $students,
        'payments' => $payments,
    ]);
}

public function principalassessment()
{
    $assessments = Assessment::all(); 
    return view('principalassessment', compact('assessments'));
}

public function principaleditassessment()
{
    return view('principaleditassessment');
}


public function approvedpayment()
{
    $students = register_form::where('status', 'approved')->get();
    $payments = payment_form::where('status', 'approved')->get();

    return view('approvedpayment', compact('students', 'payments'));
}

    public function sectioning()
    {
        $students = register_form::all();
        $payments = payment_form::all();

        return view('sectioning', [
            'students' => $students,
            'payments' => $payments,
        ]);
    }

    public function assigning()
    {
        $students = register_form::all();
        $payments = payment_form::all();
        $classes = classes::all();

        return view('assigning', [
            'students' => $students,
            'payments' => $payments,
            'classes' => $classes
        ]);
    }

    public function section()
    {
        $students = register_form::all();
        $payments = payment_form::all();
        $classes = classes::all();

        return view('section', [
            'students' => $students,
            'payments' => $payments,
            'classes' => $classes
        ]);
    }

    public function proofofpayment()
    {
        $students = register_form::all();
        $payments = payment_form::all();

        return view('cashierstudentfee', [
            'students' => $students,
            'payments' => $payments,
        ]);
    }

    //admin
    public function admin()
    {
        return view('admin');
    }

    public function adminmanageclassload()
    {
        return view('adminmanageclassload');
    }
    public function adminstudent()
    {
        return view('adminstudent');
    }
    public function adminreport()
    {
        return view('adminreport');
    }
    public function adminusers()
    {
        $account = User::all();
        return view('adminusers', compact('account'));
    }
    public function adminnotification()
    {
        return view('adminnotification');
    }

    public function adminprofile()
    {
        return view('adminprofile');
    }


    public function newstudent()
    {
        return view('newstudent');
    }

    public function oldstudent()
    {
        return view('oldstudent');
    }

    public function oldstudentdashboard()
    {
        return view('oldstudentdashboard');
    }

    public function oldstudentaddress()
    {
    $registerFormId = session('register_form_id');
    $registerForm = \App\Models\register_form::find($registerFormId);

    if (!$registerForm) {
        return redirect()->route('oldstudentaddress')->withErrors(['error' => 'Register form not found.']);
    }

    return view('oldstudentaddress', compact('registerForm'));
    }

    public function oldstudentprevious()
    {
        $registerFormId = session('register_form_id');
        $registerForm = \App\Models\register_form::find($registerFormId);

        if (!$registerForm) {
            return redirect()->route('oldstudentprevious')->withErrors(['error' => 'Register form not found.']);
    }

    return view('oldstudentprevious', compact('registerForm'));
    }

    public function oldstudentdocuments()
    {
        return view('oldstudentdocuments');
    }

    public function oldstudentpayment()
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect('/oldstudentenrollment')->with('error', 'User not authenticated.');
        }
    
        $registerForm = \App\Models\register_form::where('user_id', $user->id)->first();
    
        if (!$registerForm) {
            return redirect('/oldstudentenrollment')->with('error', 'Register form not found.');
        }

        session(['register_form_id' => $registerForm->id]);
    
        $payment = \App\Models\payment_form::where('payment_id', $registerForm->id)->get();
    
        return view('oldstudentpayment', compact('payment', 'registerForm'));
    }

        public function oldstudentassessment(Request $request)
    {
        $schoolYears = assessment::select('school_year')->distinct()->pluck('school_year');

        $user = Auth::user();
        $paymentId = $user ? $user->payment_id : null; 

        $userPayment = payment_form::where('payment_id', $paymentId)->first();
        $authGradeLevel = $userPayment ? strtolower(str_replace(' ', '', trim($userPayment->level))) : null;

        $assessments = assessment::where('status', 'Published');

        if ($request->has('school_year') && $request->school_year !== '') {
            $assessments = $assessments->where('school_year', $request->school_year);
        }

        if ($authGradeLevel) {
            $assessments = $assessments->where('grade_level', '=', $authGradeLevel); // Exact match
        }

        $assessments = $assessments->get();

        return view('oldstudentassessment', compact('assessments', 'schoolYears', 'authGradeLevel'));
    }


        public function oldstudentenrollment()
        {
            if (!Auth::check()) {
                return redirect()->route('login');
            }
        
            $user = Auth::user();
        
            $registerForm = register_form::where('user_id', $user->id)->first();
        
            if (!$registerForm) {
                return redirect()->route('/oldstudentenrollment')->with('error', 'No registration form found.');
            }
        
            $registerFormId = $registerForm->id;
        
            $studentDetail = studentdetails::where('details_id', $registerFormId)->first();
            $address = address::where('address_id', $registerFormId)->first();
            $payment = payment_form::where('payment_id', $registerFormId)->first();
            $previousSchool = previous_school::where('school_id', $registerFormId)->first();
            $requiredDocs = required_docs::where('required_id', $registerFormId)->first();
            $assign = assign::where('class_id', $registerFormId)->first();
        
            $allCompleted = true;
        
            $paymentStatus = $payment && is_object($payment) ? $payment->status : null;
            if ($paymentStatus !== 'approved') {
                $allCompleted = false;
            }

            $detailsStatus = $studentDetail && is_object($studentDetail) ? $studentDetail->status : null;
            if ($detailsStatus !== 'approved') {
                $allCompleted = false;
            }

            $addressStatus = $address && is_object($address) ? $address->status : null;
            if ($addressStatus !== 'approved') {
                $allCompleted = false;
            }

            $previousStatus = $previousSchool && is_object($previousSchool) ? $previousSchool->status : null;
            if ($previousStatus !== 'approved') {
                $allCompleted = false;
            }

            $requiredStatus = $requiredDocs && is_object($requiredDocs) ? $requiredDocs->status : null;
            if ($requiredStatus !== 'approved') {
                $allCompleted = false;
            }

            $assignStatus = $assign && is_object($assign) ? $assign->status : null;
            if ($assignStatus !== 'assigned') {
                $allCompleted = false;
            }
        
            $address_id = $address ? $address->address_id : null;
            $details_id = $studentDetail ? $studentDetail->details_id : null;
            $school_id  = $previousSchool ? $previousSchool->school_id : null;
            $required_id = $requiredDocs ? $requiredDocs->required_id : null;
            $payment_id = $payment ? $payment->payment_id : null;
            $class_id = $assign ? $assign->class_id : null;
        
            return view('oldstudentenrollment', compact(
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

    public function oldstudentupdatedetails()
    {
        $user = Auth::user();

        if (!$user || !$user->details_id) {
            return redirect('/oldstudentenrollment')->with('error', 'Details not found.');
        }

        $details = studentdetails::findOrFail($user->details_id);

        return view('oldstudentupdatedetails', compact('details'));
    }
    public function oldstudentupdateaddress()
    {
        $user = Auth::user();
        if (!$user || !$user->address_id) {
            return redirect('/oldstudentenrollment')->with('error', 'Details not found.');
        }
        $address = address::findOrFail($user->address_id);

        return view('oldstudentupdateaddress', compact('address'));
    }

    public function oldstudentupdateprevious()
    {
        $user = Auth::user();

        if (!$user || !$user->address_id) {
            return redirect('/oldstudentenrollment')->with('error', 'Details not found.');
        }

        $previous = previous_school::findOrFail($user->address_id);

        return view('oldstudentupdateprevious', compact('previous'));
    }

    public function oldstudentupdatedocuments()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/oldstudentenrollment')->with('error', 'User not authenticated.');
        }

        $registerForm = \App\Models\register_form::where('user_id', $user->id)->first();

        if (!$registerForm) {
            return redirect('/oldstudentenrollment')->with('error', 'Register form not found.');
        }

        $docs = \App\Models\required_docs::where('required_id', $registerForm->id)->get();

        return view('oldstudentupdatedocuments', compact('docs', 'registerForm'));
    }




    public function oldstudentgrades()
{
    $userId = Auth::id();
    
    // Get the authenticated user
    $user = Auth::user();
    
    // Construct the full name
    $userName = trim("{$user->firstname} {$user->middlename} {$user->lastname}");

    // Retrieve grades for the authenticated student based on their fullname and status
    $grades = Grade::where('fullname', $userName)
                   ->where('status', 'approved')
                   ->get(['subject', 'edp_code', 'section', '1st_quarter', '2nd_quarter', '3rd_quarter', '4th_quarter', 'overall_grade']);

    // Check if there are any approved grades
    $gradesApproved = $grades->isNotEmpty();

    return view('oldstudentgrades', [
        'grades' => $grades,
        'gradesApproved' => $gradesApproved,
    ]);
}
    public function updatedetails()
    {
        $user = Auth::user();

        if (!$user || !$user->details_id) {
            return redirect('/enrollmentstep')->with('error', 'Details not found.');
        }

        $details = studentdetails::findOrFail($user->details_id);

        return view('updatedetails', compact('details'));
    }
    public function updateaddress()
    {

        $user = Auth::user();


        if (!$user || !$user->address_id) {
            return redirect('/enrollmentstep')->with('error', 'Details not found.');
        }


        $address = address::findOrFail($user->address_id);

        return view('updateaddress', compact('address'));
    }
    public function updatedocuments()
    {
        $user = Auth::user();

        if (!$user || !$user->required_id) {
            return redirect('/enrollmentstep')->with('error', 'Details not found.');
        }

        $docs = required_docs::findOrFail($user->required_id);

        return view('updatedocuments', compact('docs'));
    }
    public function updateschool()
    {
        $user = Auth::user();


        if (!$user || !$user->school_id) {
            return redirect('/enrollmentstep')->with('error', 'Details not found.');
        }


        $school = previous_school::findOrFail($user->school_id);

        return view('updateschool', compact('school'));
    }
    public function principalteacher()
    {
        return view('principalteacher');
    }

    public function createsection()
    {
      
        $sections = section::all();
    
        return view('createsection', compact('sections'));
    }
}
