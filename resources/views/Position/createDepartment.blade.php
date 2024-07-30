<div>
    <div>
        <a href="{{ route('position.createPositionGet') }}" class="btn btn-primary">Back to create position page</a>
    </div>
    <div>
        <form method="post" action="{{ route('position.createDepartmentPost') }}">
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
