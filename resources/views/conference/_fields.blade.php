<div class="form-row">
  <div class="form-group col-md-8">
      <x-forms.input
          name="topic"
          type="text"
          value="{{ $conference->topic }}"
          label="Тема"
          class="col-md-8"
      />
  </div>

  <div class="form-group col-md-4">
      <x-forms.input
          name="start_date"
          type="date"
          value="{{ $conference->start_date }}"
          label="Дата проведения"
          class="col-md-8"
      />
  </div>
</div>