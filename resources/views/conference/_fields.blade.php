<div class="form-row">
  <div class="form-group col-md-8">
      <x-forms.input
          name="topic"
          type="text"
          value="{{ $conference->topic }}"
          label="Тема"
      />
  </div>

  <div class="form-group col-md-4">
      <x-forms.input
          name="start_date"
          class="datepicker"
          type="text"
          value="{{ $conference->start_date }}"
          label="Дата проведения"
      />
  </div>
</div>