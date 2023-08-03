<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\schedule;
use App\service;
use App\master;
use App\User;
use App\review;
use App\time;
use App\cosmetics;
use App\Admin;
use App\mastersRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\InboxMessage;
use App\Http\Requests\ContactFormRequest;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function main()
    {
        $schedule = new schedule;
        $service = new service;
        $master = new master;
        $time = new Time;
        return view('index', ['data' =>  $schedule->all(), 'master' => $master->all(), 'time' => $time->all(), 'service' => $service->all()]);
    }

    public function cosmetics()
    {
        $cosmetics = new cosmetics;
        $cosmetics =  $cosmetics->orderBy('price')->get();
        return view('cosmetics', ['cosmetics' =>  $cosmetics]);
    }

    public function reviews()
    {
        $reviews = new review;
        $reviewsPubl = $reviews->where('published', '=', true)->get();
        return view('aboutUs', ['reviews' =>  $reviewsPubl]);
    }
    public function services()
    {
        $schedule = new schedule;
        $master = new master;
        $time = new Time;
        $services = new service;
        $services =  $services->orderBy('servicePrice')->get();
        return view('services', ['data' =>  $schedule->all(), 'master' => $master->all(), 'time' => $time->all(), 'services' => $services]);
    }

    public function sortServices(Request $request)
    {
        $services = new service;
        $sort = '<div class="row">';
        if ($request->check == 'increase') {
            $services =  $services->orderBy('servicePrice')->get();
        } else {
            $services =  $services->orderBy('servicePrice', 'desc')->get();
        }

        foreach ($services as $el) {
            $imageUrl = asset('/storage/' . $el['serviceImg']);
            $sort .= '<div class="col-6">
            <img src="' . $imageUrl . '" alt="">
            <div class=" card-body">
                <div class="cardBack">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="card-title">' . $el['serviceName'] . '</h5>
                            <p class="card-text">' . $el['serviceDescription'] . '</p>
                            <div class="row">
                                            <div class="col-6 my-auto">
                                                <p class="card-title">Цена: ' . $el['servicePrice'] . ' руб.</p>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button class="' . $el['id'] . ' button btn btn-outline-light btn-lg openForm ">Записаться</button>
                                            </div>
                                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        $sort .= '</div>';
        return response()->json(['status' => true, "message" => $sort]);
    }
    public function sortCosmetics(Request $request)
    {
        $cosmetics = new cosmetics;
        $sort = '<div class="row">';
        if ($request->check == 'increase') {
            $cosmetics =  $cosmetics->orderBy('price')->get();
        } else {
            $cosmetics =  $cosmetics->orderBy('price', 'desc')->get();
        }

        foreach ($cosmetics as $el) {
            $imageUrl = asset('/images/' . $el['img']);
            $sort .= '<div class = "col-4 mt-4">
            <img src="' . $imageUrl . '" class="card-img-top" alt="">
            <div class="card-body fullDescr">
             <h5 class="card-title">' . $el['name'] . '</h5>
             <p class="card-text">' . $el['fullDescription'] . '</p>
            </div>
            <div class="card-body descr">
             <h5 class="card-title">' . $el['name'] . '</h5>
             <p class="card-text">' . $el['description'] . '</p>
             <p class="display-6">' . $el['price'] . ' руб.</p>
            </div>
        </div>';
        }
        $sort .= '</div>';
        return response()->json(['status' => true, "message" => $sort]);
    }

    public function masters()
    {
        $masterRatings = new mastersRating;
        $masters = new master;
        foreach ($masters->all() as $master) {
            $mark = 0;
            $arrMark = array();
            $masterMark = $masterRatings->where('master_id', '=', $master->id)->where('mark', '!=', -1)->get();
            foreach ($masterMark as $el) {
                array_push($arrMark, $el->mark);
            }
            if ($arrMark != null) {
                $mark = round(array_sum($arrMark) / sizeof($arrMark), 2);
                $master->masterRating = $mark;
                $master->save();
            } else {
                $mark = 0;
                $master->masterRating = $mark;
                $master->save();
            }
        }
        $schedule = new schedule;
        $time = new Time;
        $services = new service;
        $services =  $services->orderBy('servicePrice')->get();
        return view('masters', ['masters' =>  $masters->all(), 'data' =>  $schedule->all(), 'time' => $time->all(), 'service' => $services, 'masterRatings' =>  $masterRatings->all()]);
    }
    public function contacts()
    {
        return view('contacts');
    }
    public function searchQ($page, $query)
    {
        if ($page == 'cosmetics') {
            $cosmetics = new cosmetics;
            $cosmetics = $cosmetics->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->get();
            return view('cosmetics', ['cosmetics' =>  $cosmetics, 'search' => $query]);
        }
        if ($page == 'masters') {
            $masterRatings = new mastersRating;
            $masters = new master;
            $masters = $masters->where('masterFIO', 'like', '%' . $query . '%')
                ->orWhere('masterRating', 'like', '%' . $query . '%')
                ->orWhere('masterDescr', 'like', '%' . $query . '%')
                ->get();
            foreach ($masters->all() as $master) {
                $mark = 0;
                $arrMark = array();
                $masterMark = $masterRatings->where('master_id', '=', $master->id)->where('mark', '!=', -1)->get();
                foreach ($masterMark as $el) {
                    array_push($arrMark, $el->mark);
                }
                if ($arrMark != null) {
                    $mark = round(array_sum($arrMark) / sizeof($arrMark), 2);
                    $master->masterRating = $mark;
                    $master->save();
                } else {
                    $mark = 0;
                    $master->masterRating = $mark;
                    $master->save();
                }
            }
            $schedule = new schedule;
            $time = new Time;
            $services = new service;
            $services =  $services->orderBy('servicePrice')->get();
            return view('masters', ['masters' =>  $masters, 'data' =>  $schedule->all(), 'time' => $time->all(), 'search' => $query, 'service' => $services, 'masterRatings' =>  $masterRatings->all()]);
        }
        if ($page == 'services') {
            $services = new service;
            $services = $services->where('serviceName', 'like', '%' . $query . '%')
                ->orWhere('serviceDescription', 'like', '%' . $query . '%')
                ->get();
            $schedule = new schedule;
            $master = new master;
            $time = new Time;
            return view('services', ['data' =>  $schedule->all(), 'master' => $master->all(), 'time' => $time->all(), 'services' => $services, 'search' => $query]);
        }
    }

    public function search(Request $request)
    {
        $cosmetics = new Cosmetics;
        $master = new master;
        $service = new service;
        $query = $request->input('query');
        $text = " ";

        $cosmeticText = $cosmetics->where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();

        if (count($cosmeticText)) {
            $page = 'cosmetics';
            $text .=
                '<div class="row"> <div class="col-12">
                    <div class="title">
                    <a href="search/' . $page . '-finde:' . $query . '"><h1 class="display-6 beigeColor">Товары</h1></a>
                    </div>
                </div> </div>';
        }
        foreach ($cosmeticText as $row) {
            $imageUrl = asset('/images/' . $row['img']);
            $text .=
                '<div class="col-12 position py-2">
                    <div class="row">
                        <div class="col-2">
                        <img src="' . $imageUrl . '" class="img-fluid py-2" alt="">        
                        </div>
                        <div class="col-10">
                            <div class="searchTitle">' . $row['name'] . '</div>
                            <div class="">Цена: ' . $row['price'] . ' руб.</div>
                            <div class="cosmText display-8">' . $row['description'] . '</div>
                        </div>
                    </div>
                </div>';
        }

        $masterText = $master->where('masterFIO', 'like', '%' . $query . '%')
            ->orWhere('masterRating', 'like', '%' . $query . '%')
            ->orWhere('masterDescr', 'like', '%' . $query . '%')
            ->get();

        if (count($masterText)) {
            $page = 'masters';
            $text .=
                '<div class="row"> <div class="col-12">
                    <div class="title">
                    <a href="search/' . $page . '-finde:' . $query . '"><h1 class="display-6 beigeColor">Мастера</h1></a>               
                    </div>
                </div> </div>';
        }
        foreach ($masterText as $row) {
            $imageUrl = asset('/storage/' . $row['masterImg']);
            $text .=
                '<div class="col-12 position py-2">
                    <div class="row">
                        <div class="col-2">
                        <img src="' . $imageUrl . '" class="img-fluid py-2" alt="">  
                        </div>
                        <div class="col-10">
                            <div class="searchTitle">' . $row['masterFio'] . '</div>
                            <div class="">Оценка: ' . $row['masterRating'] . '</div>
                            <div class="cosmText">' . $row['masterDescr'] . '</div>
                        </div>
                    </div>
                </div>';
        }

        $serviceText = $service->where('serviceName', 'like', '%' . $query . '%')
            ->orWhere('serviceDescription', 'like', '%' . $query . '%')
            ->get();

        if (count($serviceText)) {
            $page = 'services';
            $text .=
                '<div class="row"> <div class="col-12">
                    <div class="title">
                    <a href="search/' . $page . '-finde:' . $query . '"><h1 class="display-6 beigeColor">Услуги</h1></a>         
                    </div>
                </div></div>';
        }
        foreach ($serviceText as $row) {
            $imageUrl = asset('/storage/' . $row['serviceImg']);
            $text .=
                '<div class="col-12 position py-2">
                    <div class="row">
                        <div class="col-2">
                        <img src="' . $imageUrl . '" class="img-fluid py-2" alt="">                            
                        </div>
                        <div class="col-10">
                            <div class="searchTitle">' . $row['serviceName'] . '</div>
                            <div class="">Цена: ' . $row['servicePrice'] . ' руб.</div>
                            <div class="cosmText display-8">' . $row['serviceDescription'] . '</div>
                        </div>
                    </div>
                </div>';
        }

        if (!count($cosmeticText) && !count($masterText)  && !count($serviceText)) {
            $text = '<div class="row"> <div class="col-12">
                <div> По вашему запросу ничего не найдено </div> 
                </div> </div>';
        }
        if ($query == null) {
            $text = '';
        }

        return response()->json(['status' => true, "message" => $text]);
    }

    public function chooseRemedy(Request $request)
    {
        $cosmetics = new cosmetics;
        $text = '<div class="row">';
        $peculiarity = " ";
        $peculiarityBeard = " ";
        $arrProduct = array();
        $arr = array();
        $arrType = array();
        foreach ($request->peculiarity as $el) {
            if($el != 'ничего'){
                $peculiarity .= $el . ',';
            }
        }
        foreach ($request->peculiarityBeard as $el) {
            if($el != 'ничего'){
                $peculiarityBeard .= $el . ',';
            }
        }

        if ($request->type == 'волосы') {
            $options = $request->type . ', ' . $request->typeHair . ', ' . $peculiarity .
                $request->washingFrequency . ', ' . $request->price;
        } else {
            $options = $request->type . ', ' . $request->rigidity . ', ' . $peculiarityBeard .
                $request->washingFrequencyBeard  . ', ' . $request->price;
        }

        if ($request->type == 'волосы') {

            $cosmetic = $cosmetics->where('keywords', 'like', '%' . $request->type . '%')
                ->where('keywords', 'like', '%' . $request->typeHair . '%')
                ->where('keywords', 'like', '%' . $request->washingFrequency . '%')
                ->where('keywords', 'like', '%' . $request->price . '%')
                ->get();

            foreach ($cosmetic as $el) {
                array_push($arrProduct, $el);
            }

            if ($peculiarity != " ничего,") {
                foreach ($request->peculiarity as $el) {
                    $cosmetic = $cosmetics->where('keywords', 'like', '%' . $el . '%')->get();
                    foreach ($cosmetic as $el) {
                        array_push($arr, $el);
                    }
                }
                $arrProduct = array_intersect($arrProduct, $arr);
            }

            foreach ($request->producType as $el) {
                $cosmetic = $cosmetics->where('keywords', 'like', '%' . $el . '%')->get();
                foreach ($cosmetic as $el) {
                    array_push($arrType, $el);
                }
            }
            $intersection = array_intersect($arrProduct, $arrType);
        } else {
            $cosmetic = $cosmetics->where('keywords', 'like', '%' . $request->type . '%')
                ->where('keywords', 'like', '%' . $request->rigidity . '%')
                ->where('keywords', 'like', '%' . $request->washingFrequencyBeard . '%')
                ->where('keywords', 'like', '%' . $request->price . '%')
                ->get();

            foreach ($cosmetic as $el) {
                array_push($arrProduct, $el);
            }

            if ($peculiarity != " ничего,") {
                foreach ($request->peculiarityBeard as $el) {
                    $cosmetic = $cosmetics->where('keywords', 'like', '%' . $el . '%')->get();
                    foreach ($cosmetic as $el) {
                        array_push($arr, $el);
                    }
                }
                $arrProduct = array_intersect($arrProduct, $arr);
            }

            foreach ($request->producType as $el) {
                $cosmetic = $cosmetics->where('keywords', 'like', '%' . $el . '%')->get();
                foreach ($cosmetic as $el) {
                    array_push($arrType, $el);
                }
            }
            $intersection = array_intersect($arrProduct, $arrType);
        }


        $products = array_unique($intersection);

        if (!count($products)) {
            $text = '<div class="row"> <div class="col-12 text-center mt-5">
            <div> Извините, но по вашему запросу ничего не найдено!</div> 
            </div> </div>';
        } else {
            foreach ($products as $row) {
                $imageUrl = asset('/images/' . $row['img']);
                $text .=
                    '<div class="col-12 position py-4">
                        <div class="row">
                            <div class="col-2 my-auto">
                            <img src="' . $imageUrl . '" class="img-fluid" alt="">  
                            </div>
                            <div class="col-10">
                            <div class="row">
                            <div class="col-8">
                            <div class="searchTitle">' . $row['name'] . '   </div>
                            </div>
                            <div class="col-4">
                            <div class="text-right">Цена: ' . $row['price'] . ' руб.</div>
                            </div>
                            </div>
                              

                                <div class="cosmText display-8">' . $row['fullDescription'] . '</div>
                                <div class="cosmText display-8"> Подобран по запросам: ' . $options . '</div>
                            </div>
                        </div>
                    </div>';
            }
        }

        $text .= '</div>';
        return response()->json(['status' => true, "message" => $text]);
    }

    public function freeDateS(Request $request)
    {
        $schedules = new Schedule;
        $response['message'] = "";

        date_default_timezone_set('europe/moscow');

        $today = date("Y-m-d");
        $timeNow = date("H:i:s");

        $busyDates = $schedules->where('time', '=', $request->time)
            ->where('master_id', '=', $request->master)
            ->get();

        if ($request->time!=null && $timeNow >= $request->time) {
            $today = Carbon::parse($today)->format('d.m.Y');
            $response['message'] .= "$today ";
        }
        foreach ($busyDates as $el) {
            if (count($busyDates) != 0) {
                $date = Carbon::parse($el->date)->format('d.m.Y');
                $response['message'] .= "$date ";
            }
        }

        return response()->json(['message' => $response['message']]);
    }

    public function sendReview()
    {
        date_default_timezone_set('europe/moscow');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST['name']) && !empty($_POST['review'])) {

                if (!empty($_POST['mark'])) {
                    if (isset($_POST['name']) && !empty($_POST['name'])) {
                        $name = strip_tags(trim($_POST['name']));
                    }
                    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
                        $phone = strip_tags(trim($_POST['phone']));
                    }
                    if (isset($_POST['email']) && !empty($_POST['email'])) {
                        $email = strip_tags(trim($_POST['email']));
                    }
                    if (empty($_POST['phone'])) {
                        $phone = 0;
                    }
                    if (empty($_POST['email'])) {
                        $email = 0;
                    }
                    if (isset($_POST['review']) && !empty($_POST['review'])) {
                        $review = strip_tags(trim($_POST['review']));
                    }
                    if (isset($_POST['mark']) && !empty($_POST['mark'])) {
                        $mark = strip_tags(trim($_POST['mark']));
                    }

                    $sendReview = new Review;
                    $sendReview->insert([
                        'name' => $name,
                        'phone' => $phone,
                        'mark' => $mark,
                        'email' => $email,
                        'review' => $review,
                        'date' =>  date('Y-m-d'),
                        'published' => false,
                    ]);

                    echo json_encode('SUCCESS');
                } else {
                    echo json_encode('NOTVALIDMark');
                }
            } else {
                echo json_encode('NOTVALID');
            }
        } else {
            header("Location: /");
        }
    }
    public function serviceRegistration(Request $request)
    {
        $user = new User;
        $allTime = new Time;
        $schedule = new Schedule;
        date_default_timezone_set('europe/moscow');
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $today = date("Y-m-d");

        if ($request->name === null) {
            $error_fields[] = 'name';
        }

        if ($request->email === null) {
            $error_fields[] = 'email';
        }

        if ($request->phone === null) {
            $error_fields[] = 'phone';
        }

        if ($request->master === null) {
            $error_fields[] = 'master';
        }

        if ($request->time === null) {
            $error_fields[] = 'time';
        }

        if ($request->service === null) {
            $error_fields[] = 'service';
        }
        if ($request->date === null) {
            $error_fields[] = 'date';
        }

        if (!empty($error_fields)) {
            return response()->json(['status' => false, "message" => "Заполните все поля!",  "fields" => $error_fields]);
        }

        if ($date < $today) {
            return response()->json(['status' => false, "message" => "Выбарана неверная дата!",  "fields" => ["date"]]);
        }

        $busyTime = $schedule->where('date', '=', $date)
            ->where('time', '=', $request->time)
            ->where('email', '=', $request->email)
            ->get();

        $busyTime2 = $schedule->where('date', '=', $date)
            ->where('time', '=', $request->time)
            ->where('phone', '=', $request->phone)
            ->get();

        if (!count($busyTime) && !count($busyTime2)) {
            foreach ($user->all() as $user) {

                $checkEmail = $user->where('email', '=', $request->email)->get();

                if (!count($checkEmail)) {

                    $checkPhone = $user->where('phone', '=', $request->phone)->get();
                    if (!count($checkPhone)) {
                        $schedule->insert([
                            'user_id' => $request->user_id,
                            'name' => $request->name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'service_id' => $request->service,
                            'master_id' => $request->master,
                            'date' => $date,
                            'time' => $request->time,
                        ]);

                        return response()->json(['status' => true, "message" => "Запись прошла успешно!"]);
                    } else {
                        foreach ($checkPhone as $user) {
                            $schedule->insert([
                                'user_id' => $user->id,
                                'name' => $request->name,
                                'email' => $request->email,
                                'phone' => $request->phone,
                                'service_id' => $request->service,
                                'master_id' => $request->master,
                                'date' => $date,
                                'time' => $request->time,
                            ]);

                            return response()->json(['status' => true, "message" => "Запись прошла успешно!"]);
                        }
                    }
                } else {
                    foreach ($checkEmail as $user) {
                        $schedule->insert([
                            'user_id' => $user->id,
                            'name' => $request->name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'service_id' => $request->service,
                            'master_id' => $request->master,
                            'date' => $date,
                            'time' => $request->time,
                        ]);

                        return response()->json(['status' => true, "message" => "Запись прошла успешно!"]);
                    }
                }
            }
        } else {

            return response()->json(['status' => false, "message" => "Вы уже записаны на данное время!",  "fields" => ["time"]]);
        }
    }

    public function selectTime(Request $request)
    {
        date_default_timezone_set('europe/moscow');

        $allTime = new Time;
        $schedule = new Schedule;
        $date = Carbon::parse($request->date1)->format('Y-m-d');
        $response = ['message' => '<option  disabled hidden selected>Выберите время</option>'];
        $today = date("Y-m-d");
        $timeNow = date("H:i:s");

        foreach ($allTime->all() as $time) {

            $busyTime = $schedule->where('date', '=', $date)
                ->where('master_id', '=', $request->master1)
                ->where('time', '=', $time->time)
                ->get();

            $text = Carbon::parse($time->time)->format('H:i');

            if (!count($busyTime)) {
                if ($today == $date) {
                    if ($timeNow <= $time->time) {
                        $response['message'] .= "<option value = '$time->time' >$text</option>";
                    }
                } else {
                    $response['message'] .= "<option value = '$time->time' > $text</option>";
                }
            }
        }
        return response()->json(['message' => $response['message']]);
    }




    public function mailToAdmin(ContactFormRequest $message, Admin $admin)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['message'])) {

                if (isset($_POST['name']) && !empty($_POST['name'])) {
                    $name = strip_tags(trim($_POST['name']));
                }
                if (isset($_POST['phone']) && !empty($_POST['phone'])) {
                    $phone = strip_tags(trim($_POST['phone']));
                }
                if (isset($_POST['email']) && !empty($_POST['email'])) {
                    $email = strip_tags(trim($_POST['email']));
                }
                if (isset($_POST['message']) && !empty($_POST['review'])) {
                    $review = strip_tags(trim($_POST['review']));
                }

                $admin->notify(new InboxMessage($message));

                echo json_encode('SUCCESS');
            } else {
                echo json_encode('NOTVALID');
            }
        } else {
            header("Location: /");
        }
    }


    public function checkPhone(Request $request)
    {
        $operator = substr($request->phone, strpos($request->phone, "(") + 1, strpos($request->phone, ")") - strpos($request->phone, "(") - 1);
        if (($operator == '44' || $operator == '25' || $operator == '29' || $operator == '33') && strlen($request->phone) == '17') {
            $user = User::where('phone', $request->phone)->first();
            if (!$user) {
                return response()->json(['status' => true, 'message' => '']);
            } else {
                return response()->json(['status' => false, 'message' => 'Пользователь с таким номером уже зарегистрирован!', 'fields' => ['phone']]);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Указан неверный номер телефона!', 'fields' => ['phone']]);
        }
    }

    public function correctPhone(Request $request)
    {
        $operator = substr($request->phone, strpos($request->phone, "(") + 1, strpos($request->phone, ")") - strpos($request->phone, "(") - 1);
        if (($operator == '44' || $operator == '25' || $operator == '29' || $operator == '33') && strlen($request->phone) == '17') {
            return response()->json(['status' => true, 'message' => '']);
        } else {
            return response()->json(['status' => false, 'message' => 'Указан неверный номер телефона!', 'fields' => ['phone']]);
        }
    }
    public function correctEmail(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => true, 'message' => '']);
        } else {
            return response()->json(['status' => false, 'message' => 'Email указан неверно!', 'fields' => ['email']]);
        }
    }

    public function checkPassword(Request $request)
    {
        if (strlen($request->pass) >= 6) {
            return response()->json(['status' => true, "message" => ""]);
        } else {
            return response()->json(['status' => false, "message" => "Пароль должен содержать не менее 6 символов!",  "fields" => ["password"]]);
        }
    }
    public function checkEmail(Request $request)
    {
        $user = new User;

        foreach ($user->all() as $user) {

            $checkEmail = $user->where('email', '=', $request->email)->get();

            if (!count($checkEmail)) {
                return response()->json(['status' => true, "message" => ""]);
            } else {
                return response()->json(['status' => false, "message" => "Пользователь с таким email уже зарегистрирован!",  "fields" => ["email"]]);
            }
        }
    }

    public function checkUser(Request $request)
    {
        $user = new User;

        foreach ($user->all() as $user) {

            $checkUser = $user->where('email', '=', $request->email)->get();
            if ($request->password != null) {
                if (!count($checkUser)) {
                    return response()->json(['status' => false, "message" => "Пользователь с таким email не найден!",  "fields" => ["email"]]);
                } else {
                    foreach ($checkUser as $user) {
                        if (Hash::check($request->password, $user->password)) {
                            return response()->json(['status' => true]);
                        } else {
                            return response()->json(['status' => false, "message" => "Неверный пароль!",  "fields" => ["password"]]);
                        }
                    }
                }
            } else {
                if (!count($checkUser)) {
                    return response()->json(['status' => false, "message" => "Пользователь с таким email не найден!",  "fields" => ["email"]]);
                } else {
                    return response()->json(['status' => true]);
                }
            }
        }
    }
}
