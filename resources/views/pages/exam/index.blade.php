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
                                        Teste !
                                    </h3>
                                </div>




                                <div class="max-w-md mx-auto bg-white p-8
				rounded-md shadow-md"
                                     style="border: 1px solid black;">
                                    <h1 class="text-3xl font-bold mb-6
				text-green-400 text-center
				text-success">
                                        {{$gemini->language}}
                                    </h1>
                                    <h3 class="text-2xl font-bold mb-6 text-center">
                                        Coding Quiz
                                    </h3>
                                    <form id="quizForm" class="space-y-4">

                                        <!-- Question 1 -->
                                        @for($i=0;$i < $gemini->number_of_questions-1; $i++)
                                            <div class="flex flex-col mb-4">
                                                <label for="q1" class="text-lg text-gray-800 mb-2">
                                                    {{$json[$i]['question']}}
                                                </label>
                                                @for($j=0;$j < ($gemini->number_of_choices)-1; $j++)
                                                    <div class="flex items-center space-x-4">
                                                        <input type="radio" id="q1a" name="q1"
                                                               value="a" class="mr-2" required>
                                                        <label for="q1a" class="text-gray-700">
                                                            {{$json[$i]['choices'][$j]}}
                                                        </label>
                                                    </div>
                                                @endfor
                                            </div>
                                        @endfor
                                        <hr>

                                        <!-- Navigation Buttons -->
                                        <hr>

                                        <button type="button" onclick="submitQuiz()"
                                                class="bg-green-500 text-white px-4 py-2
					rounded-md mt-8">
                                            Submit
                                        </button>
                                    </form>

                                    <div id="result" class="mt-8 hidden">
                                        <h2 class="text-2xl font-bold mb-4 text-center">
                                            ???? Quiz Result
                                        </h2>
                                        <p id="score" class="text-lg
								font-semibold mb-2
								text-center">
                                        </p>
                                        <p id="feedback" class="text-gray-700 text-center"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
