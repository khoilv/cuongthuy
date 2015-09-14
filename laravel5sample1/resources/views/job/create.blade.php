@extends('layout')
@section('stylesheets')
{!!Html::style('css/jobs.css')!!}
@section('content')
<h1>Job edit</h1>
  {!!  Form::open(array('action'=>['Job\JobController@create'], 'method' => 'post','files'=>true)) !!}
    <table id="job_form">
      <tfoot>
        <tr>
          <td colspan="2">
            <input type="submit" value="Preview your job" name ="create"/>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <tr>
          <th>{!! Form::label('category', 'Category') !!}</th>
          <td class="form-group @if ($errors->has('category_id')) has-error @endif">
            {!! Form::select('category_id', [
                1 => 'Design',
                2 => 'Programming',
                3 => 'Manager'],
                '',
                ['class' => 'form-control']
             ) !!}
            @if ($errors->has('category_id')) <p class="help-block">{!! $errors->first('category_id') !!}</p>@endif
          </td>
        </tr>
        <tr>
          <th>{!! Form::label('type', 'Type') !!}</th>
          <td class="form-group @if ($errors->has('type')) has-error @endif">
            Full time  {!! Form::radio('type', 'full_time', true,['class' => 'radio-inline'])!!}
            Part time  {!! Form::radio('type', 'part_time','',['class' => 'radio-inline'])!!}
            @if ($errors->has('type')) <p class="help-block">{!! $errors->first('type') !!}</p> @endif
          </td>
        </tr>
        <tr>
          <th>{!! Form::label('company', 'Company') !!}</th>
          <td class="form-group @if ($errors->has('company')) has-error @endif">
            {!! Form::text('company','',['class' => 'form-control']) !!}
            @if ($errors->has('company')) <p class="help-block">{!! $errors->first('company') !!}</p> @endif
          </td>
        </tr>
        <tr>
          <th>{!! Form::label('logo', 'Company logo') !!}</th>
          <td class="form-group @if ($errors->has('logo')) has-error @endif">
            {!! Form::file('logo',['class' => 'form-control']) !!}
            @if ($errors->has('logo')) <p class="help-block">{!! $errors->first('logo') !!}</p> @endif
          </td>
        </tr>
        <tr>
          <th>{!! Form::label('url', 'Url') !!}</th>
          <td class="form-group @if ($errors->has('url')) has-error @endif">
            {!! Form::text('url','',['class' => 'form-control']) !!}
            @if ($errors->has('url')) <p class="help-block">{!! $errors->first('url') !!}</p> @endif
          </td>           
        </tr>
         <tr>
          <th>{!! Form::label('position', 'Position') !!}</th>
          <td class="form-group @if ($errors->has('position')) has-error @endif">
            {!! Form::text('position','',['class' => 'form-control']) !!}
            @if ($errors->has('position')) <p class="help-block">{!! $errors->first('position') !!}</p> @endif
          </td>
        </tr>
        <tr>
          <th>{!! Form::label('location', 'Location') !!}</th>
          <td class="form-group @if ($errors->has('location')) has-error @endif">
            {!! Form::text('location','',['class' => 'form-control']) !!}
            @if ($errors->has('location')) <p class="help-block">{!! $errors->first('location') !!}</p> @endif
          </td>
        </tr>
        <tr>
          <th>{!! Form::label('description', 'Description') !!}</th>
          <td class="form-group @if ($errors->has('description')) has-error @endif">
            {!! Form::text('description','',['class' => 'form-control']) !!}
            @if ($errors->has('description')) <p class="help-block">{!! $errors->first('description') !!}</p> @endif
          </td>
        </tr>
        <tr>
          <th>{!! Form::label('how_to_apply', 'How to apply?') !!}</th>
          <td class="form-group @if ($errors->has('how_to_apply')) has-error @endif">
            {!! Form::textarea('how_to_apply','',['class' => 'form-control']) !!}
            @if ($errors->has('how_to_apply')) <p class="help-block">{!! $errors->first('how_to_apply') !!}</p> @endif
          </td>
        </tr>
        <tr>
          <th>{!! Form::label('is_public', 'Is Public?') !!}</th>
          <td class="form-group @if ($errors->has('is_public')) has-error @endif">
            {!! Form::checkbox('is_public', true,['class' => 'form-control']) !!}
            @if ($errors->has('is_public')) <p class="help-block">{!! $errors->first('is_public') !!}</p> @endif
          </td>
        </tr>
        <tr>
          <th>{!! Form::label('email', 'Email') !!}</th>
          <td class="form-group <?php if ($errors->has('email')) echo 'has-error' ?>" >
            {!! Form::email('email','',['class' => 'form-control']) !!}
            @if ($errors->has('email')) <p class="help-block">{!! $errors->first('email') !!}</p> @endif
          </td>
        </tr>
      </tbody>
    </table>
    {!! Form::close()!!}
  </form>
@stop
