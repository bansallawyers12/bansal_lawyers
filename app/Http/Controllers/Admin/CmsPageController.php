<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Route;

use App\Models\CmsPage;

use Auth;
use Config;

class CmsPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
	}
	/**
     * All Cms Page.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		//check authorization start
        $check = $this->checkAuthorizationAction('cmspages', $request->route()->getActionMethod(), Auth::user()->role);
        if($check)
        {
            return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
        }
		//check authorization end
        //$query 		= CmsPage::where('user_id', '=', Auth::user()->id);
		$query 		= CmsPage::where('user_id', '!=', '');

		$totalData 	= $query->count();	//for all data

		/*if ($request->has('search_term'))
		{
			$search_term 		= 	$request->input('search_term');
			if(trim($search_term) != '')
			{
				$query->where('title', 'LIKE', '%' . $search_term . '%');
			}
		}*/

        if ($request->has('search_term')) {
            $search_term = $request->input('search_term');
            if (trim($search_term) != '') {
                $query->where(function ($q) use ($search_term) {
                    $q->where('title', 'LIKE', '%' . $search_term . '%')
                      ->orWhere('slug', 'LIKE', '%' . $search_term . '%');
                });
            }
        }
      
		if ($request->has('search_term_from'))
		{
			$search_term_from 		= 	$request->input('search_term_from');
			if(trim($search_term_from) != '')
			{
				$query->whereDate('created_at', '>=', $search_term_from);
			}
		}
		if ($request->has('search_term_to'))
		{
			$search_term_to 		= 	$request->input('search_term_to');
			if(trim($search_term_to) != '')
			{
				$query->whereDate('created_at', '<=', $search_term_to);
			}
		}

		if ($request->has('search_term') || $request->has('search_term_from') || $request->has('search_term_to'))
		{
			$totalData 	= $query->count();//after search
		}

		$lists		= $query->orderBy('id', 'desc')->latest()->paginate(20); //dd($lists);

		// return view('Admin.cms_page.index',compact(['lists', 'totalData']));

		return view('Admin.cms_page.index',compact(['lists', 'totalData']))
        ->with('i', (request()->input('page', 1) - 1) * 20);
	}

	public function create(Request $request)
	{
		return view('Admin.cms_page.create');
	}

    function getYoutubeEmbedUrl($url){
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id ;
    }

	public function store(Request $request)
	{
		$check = $this->checkAuthorizationAction('cmspages', $request->route()->getActionMethod(), Auth::user()->role);
		if($check)
		{
			return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
		}
		if ($request->isMethod('post'))
		{
			$this->validate($request, [
					'title' => 'required|max:255',
					'slug' => 'required|max:255|unique:cms_pages,slug',
					'description' => 'required'
			]);
			$requestData 		= 	$request->all();
			if($request->hasfile('image'))
			{
				$topinclu_image = $this->uploadFile($request->file('image'), Config::get('constants.cmspage'));
			}
			else
			{
				$topinclu_image = NULL;
			}

			$obj				= 	new CmsPage;
			$obj->title			=	@$requestData['title'];
			$obj->content			=	@$requestData['description'];
			$obj->status		=	@$requestData['status'];
			$obj->image		=	@$topinclu_image;
            $obj->image_alt		=	@$requestData['image_alt'];
			$obj->user_id		=	Auth::user()->id;
			//$obj->slug	=	$this->createlocSlug('cms_pages',@$requestData['title']);
			$obj->slug	=	@$requestData['slug'];
			$obj->meta_title			=	@$requestData['meta_title'];
			$obj->meta_description			=	@$requestData['meta_description'];
			$obj->meta_keyward			=	@$requestData['meta_keyward'];

            if($request->has('youtube_url'))
			{
				$youtube_url = @$requestData['youtube_url']; //'https://www.youtube.com/watch?v=oVT78QcRQtU';
                if($youtube_url != ""){
                    $embed_url = $this->getYoutubeEmbedUrl($youtube_url);
                } else {
                    $embed_url = NULL;
                }
            } else {
				$embed_url = NULL;
			} //dd($embed_url);
            $obj->youtube_url			=  $embed_url;

            if($request->hasfile('pdf_doc'))
			{
				$pdf_doc = $this->uploadFile($request->file('pdf_doc'), Config::get('constants.blog'));
			}
			else
			{
				$pdf_doc = NULL;
			}
            $obj->pdf_doc		=	@$pdf_doc;

			$saved				=	$obj->save();

			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/cms_pages')->with('success', 'Page added Successfully');
			}
		}
	}

	public function editCmsPage(Request $request, $id = NULL)
	{
		//check authorization start
		$check = $this->checkAuthorizationAction('cmspages', $request->route()->getActionMethod(), Auth::user()->role);
		if($check)
		{
			return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
		}
		//check authorization end

		if ($request->isMethod('post'))
		{
			$requestData 		= 	$request->all();

			$this->validate($request, [
    			'title' => 'required|max:255|unique:cms_pages,title,'.@$requestData['id'],
    			'slug' => 'required|max:255|unique:cms_pages,slug,'.@$requestData['id'],
    			'description' => 'required'
		    ]);

			if($request->hasfile('image'))
			{
				/* Unlink File Function Start */
				if($requestData['image'] != '')
				{
					$this->unlinkFile($requestData['old_image'], Config::get('constants.cmspage'));
				}
				/* Unlink File Function End */

				$topinclu_image = $this->uploadFile($request->file('image'), Config::get('constants.cmspage'));
			}
			else
			{
				$topinclu_image = @$requestData['old_image'];
			}
			$obj				= 	CmsPage::find(@$requestData['id']);
			$obj->title			=	@$requestData['title'];
			$obj->image			=	@$topinclu_image;
            $obj->image_alt		=	@$requestData['image_alt'];
			$obj->content		=	@$requestData['description'];
			//$obj->slug	=	$this->createlocSlug('cms_pages',@$requestData['title'], $requestData['id']);
			$obj->slug	=    @$requestData['slug'];
			$obj->meta_title			=	@$requestData['meta_title'];
			$obj->meta_description			=	@$requestData['meta_description'];
			$obj->meta_keyward			=	@$requestData['meta_keyward'];
			$obj->status		=	@$requestData['status'];
             if($request->has('youtube_url'))
			{
				$youtube_url = @$requestData['youtube_url']; //'https://www.youtube.com/watch?v=oVT78QcRQtU';
                if($youtube_url != ""){
                    $embed_url = $this->getYoutubeEmbedUrl($youtube_url);
                } else {
                    $embed_url = NULL;
                }
            } else {
				$embed_url = NULL;
			} //dd($embed_url);
            $obj->youtube_url	=  $embed_url;

            if($request->hasfile('pdf_doc'))  {
				/* Unlink File Function Start */
				if($requestData['pdf_doc'] != '')
				{
					$this->unlinkFile($requestData['old_pdf'], Config::get('constants.blog'));
				}
				/* Unlink File Function End */

				$pdf_doc = $this->uploadFile($request->file('pdf_doc'), Config::get('constants.blog'));
			}
			else
			{
				$pdf_doc = @$requestData['old_pdf'];
			}
            $obj->pdf_doc			=	@$pdf_doc;

			$saved				=	$obj->save();

			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/cms_pages')->with('success', 'CMS Page'.Config::get('constants.edited'));
			}
		}
		else
		{
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);
				if(CmsPage::where('id', '=', $id)->exists())
				{
					$fetchedData = CmsPage::find($id);
					return view('Admin.cms_page.edit', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/admin/cms_pages')->with('error', 'CMS Page'.Config::get('constants.not_exist'));
				}
			}
			else
			{
				return Redirect::to('/admin/cms_pages')->with('error', Config::get('constants.unauthorized'));
			}
		}
	}

}
