                                                            <!-- Login Section Section Starts Here -->
                                                            <div class="login-section padding-tb section-bg">
                                                                <div class="container">
                                                                    <div class="col-md-6 m-auto">
                                                                        @include('admin.components.validationMessage')
                                                                    </div>
                                                                    <div class="account-wrapper">
                                                                        <h3 class="title">Modifier mon profil</h3>
                                                                        <form class="account-form" method="POST"
                                                                            action="{{ route('user.register') }}">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                    placeholder="Nom utilisateur"
                                                                                    name="username" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                    placeholder="Email" name="email"
                                                                                    required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input type="password"
                                                                                    placeholder="Mot de passe"
                                                                                    name="password" required>
                                                                            </div>
                                                                            <input type="text" name="role"
                                                                                value="client" hidden>
                                                                            <input type="text" name="url_previous"
                                                                                value="{{ url()->previous() }}" hidden>

                                                                            <div class="form-group">
                                                                                <button type="submit"
                                                                                    class="lab-btn"><span>Modifier</span></button>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Login Section Section Ends Here -->
