<?php

namespace App\Http\Controllers\API;

use App\Models\CarBooking;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\APIController;
use App\Models\User;

class UserController extends APIController
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function getAvailableComfortCategories(Request $request): JsonResponse
    {
        $user = Auth::user();
        $comfortCategories = $user->comfortCategories();
        return $this->sendResponse($comfortCategories, 'Comfort categories retrieved successfully.');
    }
    public function getAvailableCarModels(Request $request): JsonResponse
    {
        $user = Auth::user();
        $models = $user->carModels();
        return $this->sendResponse($models, 'Car models retrieved successfully.');
    }
    public function getAvailableCars(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'start_datetime' => 'required|date_format:Y-m-d H:i:s',
            'end_datetime' => 'required|after:start_datetime|date_format:Y-m-d H:i:s',
            'model_id' => 'numeric|exists:car_models,id',
            'comfort_category_id' => 'numeric|exists:comfort_categories,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user = $request->user();

        $cars = $user->findAvailableCars(
            $request->start_datetime,
            $request->end_datetime,
            $request->model_id,
            $request->comfort_category_id);

        return $this->sendResponse($cars, 'Cars retrieved successfully.');
    }

    public function carBooking(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|exists:cars,id',
            'start_datetime' => 'required|date_format:Y-m-d H:i:s',
            'end_datetime' => 'required|after:start_datetime|date_format:Y-m-d H:i:s',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user = $request->user();

        $car = $user->findAvailableCars($request->start_datetime, $request->end_datetime)
            ->where('id', $request->car_id)
            ->first();

        if (!$car) {
            return $this->sendError('Car is not available.');
        }

        CarBooking::create([
            'car_id' => $car->id,
            'user_id' => $user->id,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
        ]);

        return $this->sendResponse($car, 'Car booked successfully.');
    }
}
