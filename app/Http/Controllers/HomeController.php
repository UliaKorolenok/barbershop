<?php

namespace App\Http\Controllers;

use App\cosmetics;
use App\schedule;
use App\service;
use App\master;
use App\mastersRating;
use App\User;
use App\review;
use App\time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        date_default_timezone_set('europe/moscow');

        $services = new Service;
        $cosmetics = new cosmetics;
        $reviews = new Review;
        $ratings = new mastersRating;
        $masters = new Master;
        $schedules = new schedule;
        $users = new User;
        $id = Auth::id();
        $today = date("Y-m-d");
        $schedule = $schedules->where('date', '<=', $today)
            ->where('user_id', '=', $id)
            ->get();


        $arrSchedule = array();
        $timeNow = date("H:i:s");
        foreach ($schedule as $el) {
            if ($el->date != $today) {
                array_push($arrSchedule, $el);
            } else {
                if ($timeNow >= $el->time) {
                    array_push($arrSchedule, $el);
                }
            }
        }


        $count = count($arrSchedule);
        $userD =  user::find($id);
        $min = 1;

        if ($count >= 6) {
            if ($count % 6 == 0) {
                $min = $count;
                if ($count == 6) {
                    $min = 1;
                    $userD->discount = 5;
                    $userD->save();
                } else {
                    if ($userD->discount < 20) {
                        $userD->discount = $userD->discount + 5;
                        $userD->save();
                    }
                }
            } else {
                $min = $count;
                do {
                    $min = $min - 1;
                } while ($min % 6);
                $min = $min + 1;
            }
        }
        $max = $min + 5;
        $discountPrice = 0;


        foreach ($arrSchedule as $el) {
            $write = true;
            foreach ($ratings->all() as $mark) {
                if ($el->id == $mark->schedule_id) {
                    $write = false;
                }
            }
            if ($write == true) {
                $ratings->insert([
                    'master_id' => $el->master_id,
                    'mark' => -1,
                    'schedule_id' => $el->id,
                    'user_id' => $el->user_id,
                    'check' => false,
                ]);
            }
        }
        $marks = $ratings->where('user_id', '=', $id)->where('check', '=', false)
            ->get();
        return view('home', [
            'count' =>  $count, 'min' => $min, 'max' => $max, 'masters' =>  $masters->all(), 'discountPrice' =>  $discountPrice, 'reviews' =>  $reviews->all(),
            'services' =>  $services->all(), 'users' =>  $users->all(), 'cosmetics' =>  $cosmetics->all(), 'schedules' => $schedules->orderBy('date', 'desc')->get(), 'marks' =>  $marks->all()
        ]);
    }
    public function deleteMark(Request $request)
    {
        $mark =  mastersRating::find($request->mark_id);

        $mark->check = true;
        $mark->save();
    }
    public function deleteServ(Request $request)
    {
        $serv =  service::find($request->id);
        $schedules = new schedule;
        $schedule = $schedules->where('service_id', '=', $request->id)->get();
        foreach($schedule as $el){
            $el->delete();
        }
        $serv->find($request->id)->delete();
        return redirect('home');
    }

    public function deleteMaster(Request $request)
    {
        $master =  master::find($request->id);
        $schedules = new schedule;
        $schedule = $schedules->where('master_id', '=', $request->id)->get();
        foreach($schedule as $el){
            $el->delete();
        }
        $master->find($request->id)->delete();
        return redirect('home');
    }
    public function deleteCosm(Request $request)
    {
        $cosm =  cosmetics::find($request->id);
        $cosm->find($request->id)->delete();
        return redirect('home');
    }
    public function addServ(Request $request)
    {
        $serv = new service();

        if ($request->name === null) {
            $error_fields[] = 'name';
        }

        if ($request->description === null) {
            $error_fields[] = 'email';
        }

        if ($request->price === null) {
            $error_fields[] = 'phone';
        }

        if (!empty($error_fields)) {
            return response()->json(['status' => false, "message" => "Заполните все поля!",  "fields" => $error_fields]);
        }

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');

            $serv->insert([
                'serviceName' => $request->name,
                'serviceDescription' => $request->description,
                'servicePrice' => $request->price,
                'serviceImg' => $path,
            ]);

            return response()->json(['status' => true, "message" => "Услуга добавлена!"]);
        } else {
            return response()->json(['status' => false,'message' => 'Изображение не загружено!']);
        }
    }

    public function rateMaster(Request $request)
    {
        $mark =  mastersRating::find($request->mark_id);
        $mark->mark = $request->rate;
        $mark->check = true;
        $mark->save();
    }
    public function publReview(Request $request)
    {
        $review =  review::find($request->review_id);
        $review->published = true;
        $review->save();
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            if ($request->fieldName == 'serviceImg') {
                $serv =  service::find($request->id);
                $serv->serviceImg = $path;
                $serv->save();
            }
            if ($request->fieldName == 'masterImg') {
                $master =  master::find($request->id);
                $master->masterImg = $path;
                $master->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'Изображение успешно изменено!',
                'path' => $path,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Произошла ошибка!'
            ]);
        }
    }


    public function updateReview(Request $request)
    {
        $review =  review::find($request->id);
        if ($request->val === null) {
            return response()->json(['status' => false, "message" => "Заполните полe!"]);
        }
        $review->review = $request->val;
        $review->save();
        return response()->json(['status' => true, "message" => "Поле успешно изменено"]);
    }

    public function updateUser(Request $request)
    {
        $userD =  user::find($request->id);
        $user = new User;


        if ($request->val === null) {
            return response()->json(['status' => false, "message" => "Заполните полe!"]);
        }

        if ($request->fieldName == 'email') {


            if (!count($user->where('email', '=', $request->val)->get())) {
                $userD->email = $request->val;
                $userD->save();
                return response()->json(['status' => true, "message" => "Поле успешно изменено"]);
            } else {
                return response()->json(['status' => false, "message" => "Пользователь с таким email уже существует!"]);
            }
        } elseif ($request->fieldName == 'phone') {
            if (!count($user->where('phone', '=', $request->val)->get())) {
                $userD->phone = $request->val;
                $userD->save();
                return response()->json(['status' => true, "message" => "Поле успешно изменено"]);
            } else {
                return response()->json(['status' => false, "message" => "Пользователь с таким email уже существует!"]);
            }
        } elseif ($request->fieldName == 'name') {
            $userD->name = $request->val;
            $userD->save();
            return response()->json(['status' => true, "message" => "Поле успешно изменено"]);
        } else {
            $userD->discount = $request->val;
            $userD->save();
            return response()->json(['status' => true, "message" => "Поле успешно изменено"]);
        }
    }
    public function update(Request $request)
    {
        $schedule =  schedule::find($request->id);

        if ($request->fieldName == 'serviceName') {

            $schedule->service_id = $request->val;
            $schedule->save();
            return response()->json(['status' => true, "message" => "Поле успешно изменено"]);
        } elseif ($request->fieldName == 'masterFio') {

            $schedule->master_id = $request->val;
            $schedule->save();
            return response()->json(['status' => true, "message" => "Поле успешно изменено"]);
        } elseif ($request->fieldName == 'date') {
            $text = Carbon::parse($request->val)->format('Y-m-d');
            $schedule->date = $text;
            $schedule->save();
            return response()->json(['status' => true, "message" => "Поле успешно изменено"]);
        } elseif ($request->fieldName == 'time') {
            $schedule->time = $request->val;
            $schedule->save();
            return response()->json(['status' => true, "message" => "Поле успешно изменено"]);
        }
    }

    public function freeMaster(Request $request)
    {
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $allMasters = new master();
        $schedule = new Schedule;
        $response = ['message' => ''];

        foreach ($allMasters->all() as $master) {
            if ($master->masterFio == $request->master) {
                $response['message'] .= '<option value="' . $master->id . ' ' . $master->masterFio . '" selected>' . $request->master . '</option>';
            }
            $busyMaster = $schedule->where('date', '=', $date)
                ->where('time', '=', $request->time)
                ->where('master_id', '=', $master->id)
                ->get();

            if (!count($busyMaster)) {

                $response['message'] .= '<option value="' . $master->id . ' ' . $master->masterFio . '">' . $master->masterFio . '</option>';
            }
        }
        return (['message' => $response['message']]);
    }

    public function freeDate(Request $request)
    {
        $schedules = new Schedule;
        $allMasters = new master();
        $response['message'] = "";

        date_default_timezone_set('europe/moscow');

        $today = date("Y-m-d");
        $timeNow = date("H:i:s");

        if ($request->time != null && $timeNow >= $request->time) {
            $today = Carbon::parse($today)->format('d.m.Y');
            $response['message'] .= "$today ";
        }

        $master = $allMasters->where('masterFio', '=', $request->master)->get();
        foreach ($master as $el) {

            $busyDates = $schedules->where('time', '=', $request->time)
                ->where('master_id', '=', $el->id)
                ->get();

            foreach ($busyDates as $el) {
                if (count($busyDates) != 0) {
                    $text = Carbon::parse($el->date)->format('d.m.Y');
                    $response['message'] .= "$text ";
                }
            }
        }
        return response()->json(['message' => $response['message']]);
    }

    public function freeTime(Request $request)
    {
        $allTime = new Time;
        $schedule = new Schedule;
        $allMasters = new master();
        date_default_timezone_set('europe/moscow');

        $date = Carbon::parse($request->date)->format('Y-m-d');
        $response = ['message' => '<option value="' . $request->time . '" selected>' . $request->time . '</option>'];
        $today = date("Y-m-d");
        $timeNow = date("H:i:s");

        $master = $allMasters->where('masterFio', '=', $request->master)->get();
        foreach ($master as $el) {
            $masterId = $el->id;
        }

        foreach ($allTime->all() as $time) {

            $busyTime = $schedule->where('date', '=', $date)
                ->where('master_id', '=', $masterId)
                ->where('time', '=', $time->time)
                ->get();

            if (!count($busyTime)) {
                if ($today == $request->date) {


                    if ($timeNow <= $time->time) {
                        $text = Carbon::parse($time->time)->format('H:i');
                        $response['message'] .= '<option value="' . $time->time . '">' . $text . '</option>';
                    }
                } else {
                    $text = Carbon::parse($time->time)->format('H:i');
                    $response['message'] .= '<option value="' . $time->time . '">' . $text . '</option>';
                }
            }
        }
        return response()->json(['message' => $response['message']]);
    }

    public function sort(Request $request)
    {
        date_default_timezone_set('europe/moscow');

        $schedule = new Schedule;
        $service = new Service;
        $master = new Master;
        $id = Auth::id();
        $userD =  user::find($id);
        $today = date("Y-m-d");
        if ($request->checkTime == 'future') {
            if ($request->check == 'price') {
                $schedule = $schedule->where('date', '>=', $today)
                    ->where('user_id', '=', $request->user_id)
                    ->get();
                $service =  $service->orderBy('servicePrice')->get();

                $response['td'] = "<thead><tr><th scope='col'>Услуга ✎</th><th scope='col'>Мастер ✎</th><th scope='col'>Цена</th>
                <th scope='col'>Дата ✎</th><th scope='col'>Время ✎</th><th scope='col'></th>
                </tr></thead><tbody>";
                foreach ($service as $el) {
                    foreach ($schedule as $arr) {
                        foreach ($master->all() as $master) {
                            if ($el->id == $arr->service_id) {
                                if ($master->id == $arr->master_id) {
                                    $response['td'] .= "<tr class='schedule'>";
                                    $response['td'] .= "<td class='$arr->id serviceName'>$el->serviceName</td>";
                                    $response['td'] .= "<td class='$arr->id masterFio'>$master->masterFio</td>";
                                    if ($userD->discount != 0) {
                                        $response['td'] .= "<td>" . $el->servicePrice * ((100 - $userD->discount) / 100) . " руб. <br><del>" . $el->servicePrice . " руб.</del></td>";
                                    } else {
                                        $response['td'] .= "<td>$el->servicePrice руб.</td>";
                                    }
                                    $date = Carbon::parse($arr->date)->format('d.m.Y');
                                    $response['td'] .= "<td class='$arr->id date'>$date</td>";
                                    $time = Carbon::parse($arr->time)->format('H:i');
                                    $response['td'] .= "<td class='$arr->id time'>$time</td>";
                                    $response['td'] .= "<td><a style='font-size: 150%; color: white;' href='deleteSchedule/{$arr->id}'>🗑</a></td>";
                                    $response['td'] .= "</tr>";
                                }
                            }
                        }
                    }
                }
                $response['td'] .= "</tbody>";
            } else {
                $schedule = $schedule->where('date', '>=', $today)
                    ->where('user_id', '=', $request->user_id)->orderBy('date')
                    ->get();
                $service =  $service->all();
                $response['td'] = "<thead><tr><th scope='col'>Услуга ✎</th><th scope='col'>Мастер ✎</th><th scope='col'>Цена</th>
                <th scope='col'>Дата ✎</th><th scope='col'>Время ✎</th><th scope='col'></th>
                </tr></thead><tbody>";
                foreach ($schedule as $arr) {
                    foreach ($service as $el) {
                        foreach ($master->all() as $master) {
                            if ($el->id == $arr->service_id) {
                                if ($master->id == $arr->master_id) {
                                    $response['td'] .= "<tr class='schedule'>";
                                    $response['td'] .= "<td class='$arr->id serviceName'>$el->serviceName</td>";
                                    $response['td'] .= "<td class='$arr->id masterFio'>$master->masterFio</td>";
                                    if ($userD->discount != 0) {
                                        $response['td'] .= "<td>" . $el->servicePrice * ((100 - $userD->discount) / 100) . " руб. <br><del>" . $el->servicePrice . " руб.</del></td>";
                                    } else {
                                        $response['td'] .= "<td>$el->servicePrice руб.</td>";
                                    }
                                    $date = Carbon::parse($arr->date)->format('d.m.Y');
                                    $response['td'] .= "<td class='$arr->id date'>$date</td>";
                                    $time = Carbon::parse($arr->time)->format('H:i');
                                    $response['td'] .= "<td class='$arr->id time'>$time</td>";
                                    $response['td'] .= "<td><a style='font-size: 150%; color: white;' href='deleteSchedule/{$arr->id}'>🗑</a></td>";
                                    $response['td'] .= "</tr>";
                                }
                            }
                        }
                    }
                }
                $response['td'] .= "</tbody>";
            }
        } else {
            if ($request->check == 'price') {
                $schedule = $schedule->where('date', '<=', $today)
                    ->where('user_id', '=', $request->user_id)
                    ->get();

                $arrSchedule = array();
                $timeNow = date("H:i:s");
                foreach ($schedule as $el) {
                    if ($el->date != $today) {
                        array_push($arrSchedule, $el);
                    } else {
                        if ($timeNow >= $el->time) {
                            array_push($arrSchedule, $el);
                        }
                    }
                }

                $service =  $service->orderBy('servicePrice')->get();
                $response['td'] = "<thead><tr><th scope='col'>Услуга</th><th scope='col'>Мастер</th><th scope='col'>Цена</th>
                <th scope='col'>Дата</th><th scope='col'>Время</th><th scope='col'></th>
                </tr></thead><tbody>";
                foreach ($service as $el) {
                    foreach ($arrSchedule as $arr) {
                        foreach ($master->all() as $master) {
                            if ($el->id == $arr->service_id) {
                                if ($master->id == $arr->master_id) {
                                    $response['td'] .= "<tr>";
                                    $response['td'] .= "<td>$el->serviceName</td>";
                                    $response['td'] .= "<td>$master->masterFio</td>";
                                    if ($userD->discount != 0) {
                                        $response['td'] .= "<td>" . $el->servicePrice * ((100 - $userD->discount) / 100) . " руб. <br><del>" . $el->servicePrice . " руб.</del></td>";
                                    } else {
                                        $response['td'] .= "<td>$el->servicePrice руб.</td>";
                                    }
                                    $date = Carbon::parse($arr->date)->format('d.m.Y');
                                    $response['td'] .= "<td>$date</td>";
                                    $time = Carbon::parse($arr->time)->format('H:i');
                                    $response['td'] .= "<td>$time</td>";
                                    $response['td'] .= "</tr>";
                                }
                            }
                        }
                    }
                    $response['td'] .= "</tbody>";
                }
            } else {
                $schedule = $schedule->where('date', '<', $today)
                    ->where('user_id', '=', $request->user_id)->orderBy('date')
                    ->get();
                $arrSchedule = array();
                $timeNow = date("H:i:s");
                foreach ($schedule as $el) {
                    if ($el->date != $today) {
                        array_push($arrSchedule, $el);
                    } else {
                        if ($timeNow >= $el->time) {
                            array_push($arrSchedule, $el);
                        }
                    }
                }
                $service =  $service->all();
                $response['td'] = "<thead><tr><th scope='col'>Услуга</th><th scope='col'>Мастер</th><th scope='col'>Цена</th>
                <th scope='col'>Дата</th><th scope='col'>Время</th><th scope='col'></th>
                </tr></thead><tbody>";
                foreach ($arrSchedule as $arr) {
                    foreach ($service as $el) {
                        foreach ($master->all() as $master) {
                            if ($el->id == $arr->service_id) {
                                if ($master->id == $arr->master_id) {
                                    $response['td'] .= "<tr>";
                                    $response['td'] .= "<td>$el->serviceName</td>";
                                    $response['td'] .= "<td>$master->masterFio</td>";
                                    if ($userD->discount != 0) {
                                        $response['td'] .= "<td>" . $el->servicePrice * ((100 - $userD->discount) / 100) . " руб. <br><del>" . $el->servicePrice . " руб.</del></td>";
                                    } else {
                                        $response['td'] .= "<td>$el->servicePrice руб.</td>";
                                    }
                                    $date = Carbon::parse($arr->date)->format('d.m.Y');
                                    $response['td'] .= "<td>$date</td>";
                                    $time = Carbon::parse($arr->time)->format('H:i');
                                    $response['td'] .= "<td>$time</td>";
                                    $response['td'] .= "</tr>";
                                }
                            }
                        }
                    }
                }

                $response['td'] .= "</tbody>";
            }
        }
        return response()->json(['status' => true, "td" =>  $response['td']]);
    }


    public function deleteSchedule($id)
    {
        $schedule = new Schedule();
        $schedule->find($id)->delete();
        return redirect('home');
    }
    public function deleteReview($id)
    {
        $review = new review();
        $review->find($id)->delete();
        return redirect('home');
    }
}
