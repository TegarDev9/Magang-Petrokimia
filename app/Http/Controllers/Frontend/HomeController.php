<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Competition;
use App\Models\Gallery;
use App\Models\LatestVideo;
use App\Models\SubLatestVideo;
use App\Models\Testimonial;
use App\Models\Timeline;
use App\Models\UpcomingMatch;
use App\Models\Result;
use App\Models\ResultSingle;
use App\Models\Sponsorship;
use App\Models\Klasemen;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $newsItems = Article::take(3)->get();
        $articles = Article::whereStatus(1)->take(3)->orderBy('publish_date', 'desc')->get();
        $testimonials = Testimonial::take(5)->latest()->get();
        $upcomings = UpcomingMatch::take(4)->orderBy('match_datetime', 'desc')->get();
        $latestVideos = LatestVideo::take(1)->latest()->get();
        $sublatestVideos = SubLatestVideo::take(3)->orderBy('date', 'asc')->get();
        $galleries = Gallery::take(6)->orderBy('created_at', 'asc')->get();
        $sponsorships = Sponsorship::take(6)->orderBy('created_at', 'asc')->get();
        $klasemenGroup = Klasemen::select('group')
            ->groupBy('group')
            ->first();

        if ($klasemenGroup) {
            $groupToDisplay = $klasemenGroup->group;

            $klasemens = Klasemen::where('group', $groupToDisplay)
                ->orderBy('points', 'desc')
                ->orderBy('goal_difference', 'desc')
                ->orderBy('goals_for', 'desc')
                ->get();
        } else {
            $klasemens = collect(); // Atur sebagai koleksi kosong jika tidak ada grup
        }

        $lastMatch = Result::where('match_date', '<', now())
        ->orderBy('match_date', 'desc')
        ->first();

    $previousResults = Result::where('match_date', '<', now())
        ->orderBy('match_date', 'desc')
        ->skip(1) // Skip the first result (last match)
        ->take(2) // Take the next two results
        ->get();

        return view('pages.frontend.home.index', compact('articles', 'testimonials', 'upcomings', 'latestVideos', 'sublatestVideos', 'galleries', 'sponsorships', 'klasemens', 'lastMatch', 'previousResults'));
    }

    public function blog()
    {
        return view('pages.frontend.blog.blog',[
            'latest_post' => Article::latest()->first(),
            'articles' => Article::with('Category')->whereStatus (1)->latest()->simplePaginate(5),
            'sponsorships' => Sponsorship::take(6)->orderBy('created_at', 'asc')->get(),
        ]);
    }

    // public function blog_single(Request $request)
    // {
    //     return view('pages.frontend.blog.blog-single',[
    //         'latest_post' => Article::latest()->first(),
    //         'articles' => Article::with('Category') ->whereStatus(1)->latest()->simplePaginate(5),
    //         'categories' => Category::latest()->get()
    //     ]);
    // }

    public function competition(Request $request)
    {
        $sponsorships = Sponsorship::take(6)->orderBy('created_at', 'asc')->get();

        // Ambil data klasemen dari model Klasemen
        $klasemenData = Klasemen::orderBy('group')->get();

        // Kelompokkan data klasemen berdasarkan grup
        $groupedKlasemen = $klasemenData->groupBy('group');

        // Ambil data pertandingan dari model Competition
        $competitions = Competition::orderBy('match_number')->get();

        // Kelompokkan data kompetisi berdasarkan round
        $groupedCompetitions = $competitions->groupBy('round');

        return view('pages.frontend.competition.competition', compact('sponsorships', 'groupedKlasemen', 'competitions', 'groupedCompetitions'));
    }
    public function contact(Request $request)
    {
        $sponsorships = Sponsorship::take(6)->orderBy('created_at', 'asc')->get();
        return view('pages.frontend.contact.contact', compact('sponsorships'));
    }
    // public function gallery(Request $request)
    // {
    //     $galleries = Gallery::take(6)->orderBy('created_at', 'asc')->get();
    //     $sponsorships = Sponsorship::take(6)->orderBy('created_at', 'asc')->get();

    //     return view('pages.frontend.gallery.gallery', compact('galleries', 'sponsorships'));
    // }
    public function klasemen(Request $request)
    {
        $sponsorships = Sponsorship::take(6)->orderBy('created_at', 'asc')->get();
        // Ambil data klasemen dari model Klasemen
        // $klasemens = Klasemen::orderBy('group')->orderBy('rank')->get();
        $klasemens = Klasemen::orderBy('group')
        ->orderBy('points', 'desc')
        ->orderBy('goal_difference', 'desc')
        ->orderBy('goals_for', 'desc')
        ->get();
        
        return view('pages.frontend.klasemen.klasemen', compact('sponsorships', 'klasemens'));
    }
    public function about(Request $request)
    {
        $testimonials = Testimonial::all();
        $sponsorships = Sponsorship::take(6)->orderBy('created_at', 'asc')->get();
        $galleries = Gallery::take(12)->orderBy('created_at', 'asc')->get();
        $timelines = Timeline::take(5)->orderBy('created_at', 'asc')->get();
      
        return view('pages.frontend.about.about', compact('testimonials', 'sponsorships', 'galleries','timelines'));
    }  
    public function result(Request $request)
    {
        // Mengambil semua hasil pertandingan
        $results = Result::all();
        $sponsorships = Sponsorship::take(6)->orderBy('created_at', 'asc')->get();

        return view('pages.frontend.result.result', compact('results', 'sponsorships'));
    }
    public function result_single(Request $request)
    {
        $sponsorships = Sponsorship::take(6)->orderBy('created_at', 'asc')->get();
        $resultSingle = ResultSingle::first();  // Contoh pengambilan data, sesuaikan dengan logika query Anda

        return view('pages.frontend.result.result-single', compact('sponsorships', 'resultSingle'));
    }
    public function team(Request $request)
    {
        return view('pages.frontend.team.team');
    }
    public function team_single(Request $request)
    {
        return view('pages.frontend.team-single.team');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
