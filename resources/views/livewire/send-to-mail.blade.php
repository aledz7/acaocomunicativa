<div class="mx-1">
    <a @click='sendMail = true' class="text-gray-700  hover:text-blue-700 cursor-pointer transition duration-300 ease-in-out">
        <svg xmlns="http://www.w3.org/2000/svg" class='w-5 h-5' fill='currentColor'   viewBox="0 0 1792 1792"><path d="M1792 710v794q0 66-47 113t-113 47h-1472q-66 0-113-47t-47-113v-794q44 49 101 87 362 246 497 345 57 42 92.5 65.5t94.5 48 110 24.5h2q51 0 110-24.5t94.5-48 92.5-65.5q170-123 498-345 57-39 100-87zm0-294q0 79-49 151t-122 123q-376 261-468 325-10 7-42.5 30.5t-54 38-52 32.5-57.5 27-50 9h-2q-23 0-50-9t-57.5-27-52-32.5-54-38-42.5-30.5q-91-64-262-182.5t-205-142.5q-62-42-117-115.5t-55-136.5q0-78 41.5-130t118.5-52h1472q65 0 112.5 47t47.5 113z"/></svg>
    </a>
    <div x-show='sendMail' class="fixed z-20 bg-black bg-opacity-50 left-0 right-0 top-0 bottom-0 py-10 px-4 sm:p-20" style="display: none;">
        <div x-show.transition='sendMail' @='sendMail = false'  class="bg-white rounded shadow-2xl sm:w-10/12 md:w-8/12 lg:w-3/12 mx-auto" >
            <div class="px-6 py-3 border-b border-gray-200 hover:border-gray focus:border-gray text-gray-700-200 flex justify-end">
                <button @click='sendMail = false' >Fechar</button>
            </div>
            <div class="px-10 py-6 ">
                <div class="flex flex-col p-2 bg-gray-100">
                    <span class="font-bold">{{$title}}</span>
                    <span class="italic text-gray-700 text-xs">{{$short_text}}</span>
                </div>
                <div class="py-2 font-bold text-left">
                    Enviar para:
                </div>
                <div class="mb-4">
                    <input type="text" wire:model.bounce.400ms='to' class="w-full border-b-2 border-gray-400 hover:border-actionblue focus:border-actionblue text-gray-700" placeholder="email@email.com.br">
                    @error( 'to' ) <span class="text-red-600 text-xs">{{$message}}</span> @enderror
                </div>
                <div class="py-2 font-bold text-left">
                    Seus dados:
                </div>
                <div>
                    <div class="mb-4">
                        <input type="text" wire:model='by_name' class="w-full border-b-2 border-gray-400 hover:border-actionblue focus:border-actionblue text-gray-700" placeholder="Nome">
                        @error( 'by_name' ) <span class="text-red-600 text-xs">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <input type="text" wire:model='by_email' class="w-full border-b-2 border-gray-400 hover:border-actionblue focus:border-actionblue text-gray-700" placeholder="Email">
                        @error( 'by_email' ) <span class="text-red-600 text-xs">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <textarea wire:model='comments' class="w-full border-b-2 border-gray-400 hover:border-actionblue focus:border-actionblue focus:outline-none text-gray-700" placeholder="Comentário"></textarea>
                        @error( 'comments' ) <span class="text-red-600 text-xs">{{$message}}</span> @enderror
                    </div>
                    <div class="flex justify-between">
                        <div>
                            <span wire:loading wire:target='send'>Enviando...</span>
                            <span wire:loading.remove>{{$status}}</span>
                        </div>
                        <button wire:click='send' class="bg-actionblue px-2 py-1 rounded text-white">
                            <span wire:loading wire:target='send'>Enviando...</span>
                            <span wire:loading.remove wire:target='send'>Enviar</span>
                        </button>
                    </div>
                </div>
                <div class="flex justify-between py-2 px-3 mt-4 bg-gray-100 rounded">
                </div>
            </div>
        </div>
    </div>
</div>
