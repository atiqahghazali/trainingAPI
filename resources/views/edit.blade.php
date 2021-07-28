<form action="{{route('update', $user)}}" method="post"> 
    @csrf
    <input type="text" id="name" name="name" placeholder="name" value="{{$user->name}}">
    <input type="email" id="email" name="email" placeholder="email" value="{{$user->email}}">
    <input type="password" id="password" name="password" placeholder="password" value="{{$user->password}}">
    <input type="submit" value="submit">
</form>