<div>
    <div>
        <a href="{{ route('workArea.administrator') }}" class="btn btn-primary">Back to WORK AREA</a>
    </div>
    <div>
        <form method="post" action="{{ route('position.createRolePost') }}">
            @csrf
            <div>
                <div class="labelDiv"><label>Name</label></div>
                <input id="nameInput" type="text" name="name" required/>
                @if ($errors->has('name'))
                    <label class="errorLabel">{{ $errors->first('name') }}</label>
                @endif
            </div>
            <div>
                <input id="button" type="submit" name="create" value="Create"/>
            </div>
        </form>
    </div>
</div>
