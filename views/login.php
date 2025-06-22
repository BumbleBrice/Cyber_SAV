<h2 class="title is-3 has-text-centered">Login</h2>

<div class="box" style="max-width: 400px; margin: auto;">
    <form method="post" action="?page=login" novalidate>
        <div class="field">
            <label class="label" for="username">Username</label>
            <div class="control">
                <input class="input" type="text" name="username" id="username" required autocomplete="username">
            </div>
        </div>

        <div class="field">
            <label class="label" for="password">Password</label>
            <div class="control">
                <input class="input" type="password" name="password" id="password" required autocomplete="current-password">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-primary is-fullwidth">Log In</button>
            </div>
        </div>
    </form>

    <p class="has-text-centered mt-4">
        <a href="?page=register">Don't have an account? Sign up</a>
    </p>
</div>
