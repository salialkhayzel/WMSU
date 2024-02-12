<div class="container mt-4">
        <div class="row">
            <!-- Left Column (Chat) -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Chat Support</h2>
                    </div>
                    <div class="card-body overflow-auto" style="max-height:400px" id="chat_content"  wire:poll.5000ms="update_data()">
                        <!-- Student's message -->
                        @if($chat_box)
                            @forelse ($chat_content as $key =>$value)
                            @if($value->cbc_user_id == $user_details['user_id'])
                                <div class="alert alert-primary text-right">
                                    <strong>Me:</strong> {{$value->cbc_chat_content}}
                                </div>
                            @else
                                <div class="alert alert text-dark text-left border-dark">
                                    <strong>Admin:</strong> {{$value->cbc_chat_content}}
                                </div>
                            @endif
                            @empty
                            @endforelse
                        @else
                        <div class="alert alert-light text-dark border-dark ">
                            <strong>Admin:</strong> Hi, Start your conversation with admin
                        </div>
                        @endif
                       
                    </div>
                    <div class="input-group mt-3 p-2">
                        <input type="text" class="form-control" wire:model="chat_content_details" placeholder="Type your message...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" wire:click="send_message()"> Send </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column (Picture) -->
            <div class="col-md-4">
                <img src="{{asset('images/logo/tecoffice.jpg')}}" alt="Image" class="img-fluid">
            </div>
        </div>
    </div>