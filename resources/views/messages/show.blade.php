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
                                        <p class="mb-0 lh-base">{{ $msg->body }}</p>
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
                        <form action="{{ route('messages.store', $user) }}" method="POST" id="chatForm">
                            @csrf
                            <div
                                class="premium-input-group d-flex align-items-center bg-light rounded- pill p-2 ps-4 shadow-sm">
                                <textarea name="body" class="form-control border-0 bg-transparent shadow-none py-2" rows="1"
                                    placeholder="{{ __('Write your message...') }}" id="messageInput" required
                                    style="resize: none;"></textarea>
                                <div class="d-flex gap-2 pe-1">
                                    <button type="button" class="btn btn-light rounded-circle shadow-none text-muted">
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
        });
    </script>
@endsection