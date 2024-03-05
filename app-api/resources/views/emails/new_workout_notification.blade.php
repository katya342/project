@component('mail::message')
# New Workout Notification

A new workout is available! Check it out and start your training.

@component('mail::button', ['url' => url('/workouts')])
View Workout
@endcomponent

Thanks,<br>
Your App
@endcomponent
