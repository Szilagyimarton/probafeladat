<a href="/" >Back </a>

<form action="/people" method="POST">
  @csrf
  <label for="name">Name</label>
  <input type="text" name="name" id="name" value="{{ old('name')}}"/>
    @error('name')
      <span>{{$message}}</span>
     @enderror
  <label for="email">Email</label>
  <input type="text" name="email" id="email" value="{{ old('email')}}"/>
      @error('email')
      <span>{{$message}}</span>
     @enderror
  <label for="dept">dept</label>
  <input type="text" name="dept" id="dept" value="{{ old('dept')}}"/>
      @error('dept')
      <span>{{$message}}</span>
      @enderror
  <label for="name">rank</label>
  <input type="text" name="rank" id="rank" value="{{ old('rank')}}"/>
      @error('rank')
      <span>{{$message}}</span>
      @enderror
  <label for="phone">phone</label>
  <span>+36 (1) 666-</span>
  <input type="text" name="phone" id="phone" value="{{ old('phone')}}"/>
        @error('phone')
        <span>{{$message}}</span>
        @enderror
  <label for="room">room</label>
  <input type="text" name="room" id="room" value="{{ old('room')}}" />
      @error('room')
      <span>{{$message}}</span>
    @enderror
  <button>Send</button>

</form>