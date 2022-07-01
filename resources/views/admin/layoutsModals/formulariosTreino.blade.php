<div class="col-sm">
    <div style="padding-top: 16.3px">
    <label for="numero_exercicios">{{ __('*Numero de exercícios') }}</label>
    <select name="numero_exercicios" id="numero_exercicios" style="background-color: #fff"
      class="form-select @error('numero_exercicios') is-invalid @enderror"
      value="{{ old('numero_exercicios') }}" required autocomplete="numero_exercicios">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
      </select>

    @error('numero_exercicios')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>

    <br>
    <label for="tex_membro1">{{ __('*Membro Muscular 1') }}</label>
    <select name="tex_membro1" id="tex_membro1" style="background-color: #fff"
      class="form-select @error('tex_membro1') is-invalid @enderror"
      value="{{ old('tex_membro1') }}" required autocomplete="tex_membro1">
          <option value="peito">Peito</option>
          <option value="costas">Costas</option>
          <option value="biceps">Biceps</option>
          <option value="triceps">Triceps</option>
          <option value="antebraco">Antebraço</option>
          <option value="ombro">Ombro</option>
          <option value="trapezio">Trapezio</option>
          <option value="inferior">Inferior</option>
          <option value="lombar">Lombar</option>
          <option value="abdomen">Abdomen</option>
      </select>

    @error('tex_membro1')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
<br>
    <label for="tex_membro2">{{ __('Membro Muscular 2') }}</label>
    <select name="tex_membro2" id="tex_membro2" style="background-color: #fff"
      class="form-select @error('tex_membro2') is-invalid @enderror"
      value="{{ old('tex_membro2') }}" autocomplete="tex_membro2">
          <option value=""></option>
          <option value="peito">Peito</option>
          <option value="costas">Costas</option>
          <option value="biceps">Biceps</option>
          <option value="triceps">Triceps</option>
          <option value="antebraco">Antebraço</option>
          <option value="ombro">Ombro</option>
          <option value="trapezio">Trapezio</option>
          <option value="inferior">Inferior</option>
          <option value="lombar">Lombar</option>
          <option value="abdomen">Abdomen</option>
      </select>

    @error('tex_membro2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
