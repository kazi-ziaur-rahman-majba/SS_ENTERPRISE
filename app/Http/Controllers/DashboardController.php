<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Auth;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;

use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

use Psr\Http\Message\UriInterface;
use Spatie\Crawler\Crawler;
use App\Models\Event;
use App\Models\Blog;
use App\Models\Admin;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::today();
        
        $data['totalAdmin'] = Admin::count();
        $data['totalBlogs'] = Blog::count();
        $data['totalEvents'] = Event::count();
        $data['totalAppointment'] = '0';

        $data['careerAppointment'] = null;
        $data['careerData'] = null;

        return view('admin.modules.dashboard.index', compact('data'));
    }

    public function sitemap()
    {
        // dd(1);s
        SitemapGenerator::create('http://demo.qligence.com/')
            ->configureCrawler(function (Crawler $crawler) {
                $crawler->ignoreRobots();
            })
            ->shouldCrawl(function (UriInterface $url) {
                return strpos($url->getPath(), 'page=') === false;
            })->writeToFile('sitemap.xml');
        
        
        

        return back()->with('success','Sitemap generated & published successfully');


        $sitemapPath = public_path('sitemap_new.xml'); 
        if (file_exists($sitemapPath)) {

            $xmlContent = file_get_contents($sitemapPath);
            // dd($xmlContent);
            return view('admin.modules.settings.siteMap', compact('xmlContent'));
        } else {
            return abort(404);
        }
    }
    public function store(request $request)
    {
        //dd($request);

        $xmlPath = public_path('sitemap.xml'); // Change to the actual path of your XML file

        // Check if the XML file exists and delete it
        if (file_exists($xmlPath)) {
            unlink($xmlPath);
        }

        // Create XML data as a string
        $xmlData = $request->siteMap;

        // Write the XML data to a new file
        file_put_contents($xmlPath, $xmlData);

        // Redirect or respond with a success message
        return redirect()->back()->with('success', 'XML file deleted and created successfully');
    }
    
    public function profile()
    {
        $chkUsr = UserProfile::where('email', Auth::user()->email)->count();
        if ($chkUsr > 0) {
            $data = UserProfile::where('email', Auth::user()->email)->first();
            return view('admin.modules.profile.profile', compact('data'));
        }
        return view('admin.modules.profile.profile');
    }
    public function profileUpdate(request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'phone' => 'required',
        ]);
        $chkUsr = UserProfile::where('email', Auth::user()->email)->count();
        $filename = '';
        if ($chkUsr > 0) {
            $filename = $request->ex_photo;
            $Usr = UserProfile::where('email', Auth::user()->email)->first();
            $data = UserProfile::find($Usr->id);
        } else {
            $data = new UserProfile();
        }
        // dd($data);
        $filename = $request->ex_photo;
        if ($request->hasfile('image')) {
            $image1 = $request->file('image');
            $filename = date('Ymd') . '-' . uniqid() . '.' . $image1->getClientOriginalExtension();
            $destinationPath1 = public_path() . '/uploads/images';
            $image1->move($destinationPath1, $filename);
        }
        // dd(1);
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name ? $request->last_name : null;
        $data->image = $filename;
        $data->phone = $request->phone ? $request->phone : null;
        $data->email = Auth::user()->email;
        $data->city = $request->city ? $request->city : null;
        $data->post_code = $request->post_code ? $request->post_code : null;
        $data->country = $request->country ? $request->country : null;
        $data->address = $request->address ? $request->address : null;
        $data->save();

        $name = $request->first_name . ' ' . $request->last_name;

        User::whereId(auth()->user()->id)->update([
            'name' => $name,
        ]);

        session()->put('adminImage', $filename);
        return redirect()->intended('admin/profile')->with('success', 'Profile data updated successfully');
    }

    public function changePassword()
    {
        $userID = Auth::user()->email;
        $checkProfile = UserProfile::where('email', $userID)->count();
        if ($checkProfile == 0) {
            $prof = new UserProfile();
            $prof->email = Auth::user()->email;
            $prof->first_name = Auth::user()->name;
            $prof->last_name = '';
            $prof->image = '';
            $prof->phone = '';
            $prof->city = '';
            $prof->post_code = '';
            $prof->country = '';
            $prof->address = '';
            $prof->save();
        }
        $profile = UserProfile::where('email', $userID)->first();
        return view('admin.modules.profile.changePassword', compact('profile'));
    }

    public function changeDoPassword(Request $request, $profileID)
    {
        $this->validate($request, [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
        ]);

        $userID = Auth::user()->id;
        $password = Hash::make($request->password);
        DB::table('users')
            ->where('id', $userID)
            ->update([
                'password' => $password,
            ]);

        return redirect('/admin/change-password')->with('success', 'Change password updated successfully');
    }
}
