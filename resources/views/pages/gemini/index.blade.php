<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Questionnaires avec l\'IA') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <div class="lg:col-span-1">
                            <div class="card h-full">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Ajouter un questionnaire
                                    </h3>
                                </div>
                                <form action="{{route('gemini.generate')}}" method="POST">
                                    @csrf
                                    <x-forms.input name="language" :label="__('Langage')"></x-forms.input>
                                    <x-forms.input name="numberOfQuestions" type="number"
                                                   :label="__('Nombre de questions')"></x-forms.input>
                                    <x-forms.input name="numberOfChoices" type="number"
                                                   :label="__('Nombre de réponses')"></x-forms.input>
                                    <button class="btn btn-primary" type="submit">Generate</button>
                                </form>
                            </div>
                        </div>


                        {{--                        <form method="POST" action="{{route('gemini.generate')}}">--}}
                        {{--                            @csrf--}}
                        {{--                            <textarea name="language" rows="4" cols="50" placeholder="Entre le nom du language "></textarea><br>--}}
                        {{--                            <textarea name="number" rows="4" cols="50" placeholder="Entre le nombre de question voulu"></textarea>--}}
                        {{--                            <button type="submit">Envoyer</button>--}}
                        {{--                        </form>--}}
                        {{--                        @if(isset($text))--}}
                        {{--                            <h2></h2>--}}
                        {{--                            <p>{!! nl2br(e($text)) !!}</p>
                        {{--                        @endif--}}

                    </div>
                    <div class="card-body flex flex-col gap-5">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap gap-5">
        @foreach($gemini as $g)
                <?php
                    $qcm = json_decode($g->qcm,true);
                ?>
            <div class="card bg-base-100 w-96 shadow-sm ">
                <div class="card-body">
                    <h2 class="card-title">{{$g->language}}</h2>
                    @if($qcm[0]['question'])
                        <p>
                            {{ $g->number_of_questions }} questions
                        </p>
                    @endif

{{--                    @can('viewAdmin', \App\Models\CohortsBilans::class)--}}

{{--                        <div class="card-actions justify-start">--}}
{{--                            <form method="post" action="{{route('knowledge.update')}}">--}}
{{--                                @csrf--}}
{{--                                @method('PUT')--}}

{{--                                <x-forms.dropdown label="Promotions" name="select" class="pr-10"--}}
{{--                                                  onchange="this.form.submit()">--}}
{{--                                    <option value="" {{ is_null($qcms->cohort_id) ? 'selected' : '' }}>Aucun</option>--}}
{{--                                    @foreach($cohort as $cohorts)--}}
{{--                                        <option--}}
{{--                                            value="{{$cohorts->id}}" {{$qcms->cohort_id == $cohorts->id ? 'selected' : ''}}>{{$cohorts->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </x-forms.dropdown>--}}
{{--                            </form>--}}

{{--                        </div>--}}
{{--                    @endcan--}}
{{--                    @if($qcms->user_bilans->where('user_id', auth()->id())->isNotEmpty() || $user->school()->pivot->role == 'admin')--}}
{{--                        <a href="{{route('adminKnowledge.index', Crypt::encrypt($qcms->id))}}">--}}
{{--                            <div class="card-actions justify-end">--}}
{{--                                <button class="btn btn-primary">Voir</button>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    @endif--}}
                            <a href="{{route('exam.index',$g->id)}}">
                                <div class="card-actions justify-end">
                                    <button class="btn btn-primary">Répondre</button>
                                </div>
                            </a>
                </div>
        @endforeach
        </div>
    </div>
        <!-- end: grid -->
</x-app-layout>
