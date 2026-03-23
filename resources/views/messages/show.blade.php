@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <!-- Premium Chat Container -->
                <div
                    class="chat-wrapper overflow-hidden shadow-2xl rounded-5 bg-white border-0 d-flex flex-column animate__animated animate__fadeIn">

                    <!-- Chat Header -->
                    <div
                        class="chat-header p-3 px-4 bg-white border-bottom d-flex align-items-center justify-content-between z-3">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('community.index') }}"
                                class="btn btn-light rounded-circle p-2 me-3 shadow-sm hover-scale">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                            <div class="position-relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D6EFD&color=fff&size=45"
                                    class="rounded-circle shadow-sm border border-2 border-white" alt="">
                                <span
                                    class="position-absolute bottom-0 end-0 bg-success border border-white border-2 rounded-circle p-1 shadow-sm"></span>
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold text-dark mb-0">{{ $user->name }}</h6>
                                <small class="text-success fw-semibold"><i class="bi bi-dot"></i> {{ __('Online') }}</small>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-light rounded-circle shadow-sm hover-up text-primary"
                                title="{{ __('Call') }}">
                                <i class="bi bi-telephone-fill"></i>
                            </button>
                            <button class="btn btn-light rounded-circle shadow-sm hover-up text-primary"
                                title="{{ __('Info') }}">
                                <i class="bi bi-info-circle-fill"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Messages Area -->
                    <div class="chat-body p-4 flex-grow-1 overflow-y-auto bg-light-subtle" id="chatBody"
                        style="height: 60vh; scroll-behavior: smooth;">
                        @forelse($messages as $msg)
                            <div
                                class="d-flex mb-4 {{ $msg->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="message-bubble-wrapper d-flex flex-column {{ $msg->sender_id === auth()->id() ? 'align-items-end' : 'align-items-start' }}"
                                    style="max-width: 80%;">
                                    <div
                                        class="message-bubble p-3 rounded-4 shadow-sm {{ $msg->sender_id === auth()->id() ? 'bg-primary text-white bubble-mine' : 'bg-white text-dark bubble-theirs' }}">
                                        @if($msg->body)
                                            <p class="mb-0 lh-base">{{ $msg->body }}</p>
                                        @endif
                                        
                                        @if($msg->file_path)
                                            <div class="mt-2 pt-2 border-top border-white border-opacity-10">
                                                @if(str_contains($msg->file_type, 'image'))
                                                    <a href="{{ Storage::url($msg->file_path) }}" target="_blank" class="d-block overflow-hidden rounded-3 shadow-sm hover-lift">
                                                        <img src="{{ Storage::url($msg->file_path) }}" class="img-fluid w-100" style="max-height: 250px; object-fit: cover;" alt="{{ $msg->file_name }}">
                                                    </a>
                                                @else
                                                    <div class="d-flex align-items-center gap-3 p-2 rounded-3 {{ $msg->sender_id === auth()->id() ? 'bg-white bg-opacity-10' : 'bg-light' }}">
                                                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:40px;height:40px;background:{{ $msg->sender_id === auth()->id() ? 'rgba(255,255,255,0.2)' : '#e9ecef' }};">
                                                            <i class="bi bi-file-earmark-text fs-5"></i>
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <div class="fw-bold truncate small mb-0">{{ $msg->file_name }}</div>
                                                            <div class="extra-small opacity-75 text-uppercase">{{ explode('/', $msg->file_type)[1] ?? 'File' }}</div>
                                                        </div>
                                                        <a href="{{ route('messages.download', $msg) }}" class="btn btn-sm btn-link {{ $msg->sender_id === auth()->id() ? 'text-white' : 'text-primary' }} p-0">
                                                            <i class="bi bi-download fs-5"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <span class="extra-small text-muted mt-2 opacity-75 letter-spacing-1">
                                        {{ $msg->sender_id === auth()->id() ? __('You') . ' • ' : '' }}{{ $msg->created_at->format('H:i') }}
                                        @if($msg->sender_id === auth()->id())
                                            <i class="bi bi-check2-all ms-1 {{ $msg->read ? 'text-info' : '' }}"></i>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div
                                class="h-100 d-flex flex-column align-items-center justify-content-center py-5 text-center opacity-50">
                                <div class="bg-primary bg-opacity-10 p-4 rounded-circle mb-3">
                                    <i class="bi bi-chat-quote-fill display-4 text-primary"></i>
                                </div>
                                <h5 class="fw-bold text-dark">{{ __('Start a Conversation') }}</h5>
                                <p class="small text-muted">
                                    {{ __('Say hello to :name and start connecting.', ['name' => $user->name]) }}</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Message Input -->
                    <div class="chat-footer p-4 bg-white border-top">
                        <form action="{{ route('messages.store', $user) }}" method="POST" id="chatForm" enctype="multipart/form-data">
                            @csrf
                            
                            {{-- File Preview Container --}}
                            <div id="filePreviewContainer" class="mb-3 d-none animate__animated animate__fadeIn">
                                <div class="d-flex align-items-center gap-3 p-2 rounded-4 bg-light shadow-sm">
                                    <div id="imagePreview" class="d-none overflow-hidden rounded-3" style="width: 50px; height: 50px;">
                                        <img src="" class="h-100 w-100" style="object-fit: cover;">
                                    </div>
                                    <div id="fileIcon" class="rounded-circle bg-white d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                        <i class="bi bi-file-earmark fs-4 text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 fw-bold small truncate" id="fileNamePreview"></p>
                                        <small class="text-muted" id="fileSizePreview"></small>
                                    </div>
                                    <button type="button" class="btn btn-light rounded-circle btn-sm shadow-none" id="removeFileBtn">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>

                            <div
                                class="premium-input-group d-flex align-items-center bg-light rounded-pill p-2 ps-4 shadow-sm">
                                <textarea name="body" class="form-control border-0 bg-transparent shadow-none py-2" rows="1"
                                    placeholder="{{ __('Write your message...') }}" id="messageInput"
                                    style="resize: none;"></textarea>
                                
                                <input type="file" name="file" id="fileInput" class="d-none">

                                <div class="d-flex gap-2 pe-1">
                                    <button type="button" class="btn btn-light rounded-circle shadow-none text-muted" id="attachBtn">
                                        <i class="bi bi-paperclip fs-5"></i>
                                    </button>
                                    <button type="button" class="btn btn-light rounded-circle shadow-none text-muted">
                                        <i class="bi bi-emoji-smile fs-5"></i>
                                    </button>
                                    <button type="submit"
                                        class="btn btn-primary rounded-circle shadow-lg hover-scale p-0 d-flex align-items-center justify-content-center"
                                        style="width: 45px; height: 45px;">
                                        <i class="bi bi-send-fill text-white fs-5 ms-1"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .chat-wrapper {
            border: 1px solid rgba(0, 0, 0, 0.05);
            height: 85vh;
            max-height: 800px;
        }

        /* Bubbles Styling */
        .message-bubble {
            position: relative;
            font-size: 0.95rem;
            transition: transform 0.2s ease;
        }

        .bubble-mine {
            border-bottom-right-radius: 4px !important;
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
        }

        .bubble-theirs {
            border-bottom-left-radius: 4px !important;
            background-color: #ffffff;
            border: 1px solid #f1f1f1;
        }

        .message-bubble:hover {
            transform: scale(1.01);
        }

        /* Input Styling */
        .premium-input-group {
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .premium-input-group:focus-within {
            border-color: #0d6efd;
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.08) !important;
            background-color: #ffffff !important;
        }

        /* Scrollbar */
        .chat-body::-webkit-scrollbar {
            width: 6px;
        }

        .chat-body::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Utilities */
        .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .extra-small {
            font-size: 0.7rem;
        }

        .letter-spacing-1 {
            letter-spacing: 0.5px;
        }

        .hover-scale {
            transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .hover-scale:hover {
            transform: scale(1.1);
        }

        .hover-up {
            transition: transform 0.2s ease;
        }

        .hover-up:hover {
            transform: translateY(-2px);
        }

        /* Fix footer on mobile */
        @media (max-width: 768px) {
            .chat-wrapper {
                height: 90vh;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBody = document.getElementById('chatBody');
            const messageInput = document.getElementById('messageInput');
            const fileInput = document.getElementById('fileInput');
            const attachBtn = document.getElementById('attachBtn');
            const filePreview = document.getElementById('filePreviewContainer');
            const removeFileBtn = document.getElementById('removeFileBtn');

            // Auto-scroll to bottom
            chatBody.scrollTop = chatBody.scrollHeight;

            // Auto-expand textarea
            messageInput.addEventListener('input', function () {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
                if (this.scrollHeight > 100) {
                    this.style.overflowY = 'auto';
                } else {
                    this.style.overflowY = 'hidden';
                }
            });

            // Submit on Enter (Shift+Enter for new line)
            messageInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    document.getElementById('chatForm').submit();
                }
            });

            // File Upload Logic
            attachBtn.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    document.getElementById('fileNamePreview').textContent = file.name;
                    document.getElementById('fileSizePreview').textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                    
                    filePreview.classList.remove('d-none');

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.querySelector('#imagePreview img').src = e.target.result;
                            document.getElementById('imagePreview').classList.remove('d-none');
                            document.getElementById('fileIcon').classList.add('d-none');
                        }
                        reader.readAsDataURL(file);
                    } else {
                        document.getElementById('imagePreview').classList.add('d-none');
                        document.getElementById('fileIcon').classList.remove('d-none');
                    }
                    
                    messageInput.removeAttribute('required');
                }
            });

            removeFileBtn.addEventListener('click', () => {
                fileInput.value = '';
                filePreview.classList.add('d-none');
                if (!messageInput.value) {
                    messageInput.setAttribute('required', 'required');
                }
            });
        });
    </script>
@endsection