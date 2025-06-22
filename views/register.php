<h2 class="title is-3 has-text-centered">Sign Up</h2>

<div class="box" style="max-width: 500px; margin: auto;">
    <form id="registerForm" method="post" action="?page=register" novalidate>
        <div class="field">
            <label class="label" for="pseudo">Username</label>
            <div class="control">
                <input class="input" type="text" id="pseudo" name="pseudo" required minlength="3">
            </div>
        </div>

        <div class="field">
            <label class="label" for="email">Email</label>
            <div class="control">
                <input class="input" type="email" id="email" name="email" required>
            </div>
        </div>

        <div class="field">
            <label class="label" for="password">Password</label>
            <div class="control">
                <input class="input" type="password" id="password" name="password" required
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$"
                    aria-describedby="passwordHelp">
            </div>
            <p class="help" id="passwordHelp">
                At least 8 characters, with uppercase, lowercase, number and special character.
            </p>
        </div>

        <div class="field">
            <label class="label" for="confirm_password">Confirm Password</label>
            <div class="control">
                <input class="input" type="password" id="confirm_password" name="confirm_password" required>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button id="submitBtn" class="button is-primary is-fullwidth" type="submit" disabled>Register</button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');

    const pseudo = document.getElementById('pseudo');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirm = document.getElementById('confirm_password');

    const validate = () => {
        const valid =
            pseudo.value.length >= 3 &&
            email.checkValidity() &&
            password.value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/) &&
            password.value === confirm.value;

        submitBtn.disabled = !valid;
    };

    [pseudo, email, password, confirm].forEach(field => {
        field.addEventListener('input', validate);
    });
});
</script>
