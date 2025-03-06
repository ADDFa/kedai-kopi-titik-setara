<?= $this->extend("layouts/main") ?>

<?= $this->section("content") ?>

<section class="w-full h-screen flex justify-center items-center p-2">
    <div class="shadow p-6 rounded-2xl w-full sm:w-md">
        <h1 class="text-4xl text-center font-bold">Login</h1>

        <form method="POST" class="mt-5">
            <div class="flex items-center border-b border-b-zinc-400 ">
                <i class="bi bi-person-badge pe-3 text-2xl text-zinc-400"></i>
                <input autocomplete="off" type="text" placeholder="Username" name="username" id="username" class="floating-input-icon" value="<?= old("username") ?>" />
            </div>
            <p class="invalid-feedback"><?= session("errors.username") ?></p>

            <div class="flex items-center border-b border-b-zinc-400 mt-6">
                <i class="bi bi-person-lock pe-3 text-2xl text-zinc-400"></i>
                <input autocomplete="off" type="password" placeholder="Password" name="password" id="password" class="floating-input-icon" value="<?= old("password") ?>" />
            </div>
            <p class="invalid-feedback"><?= session("errors.password") ?></p>

            <div class="mt-10 mb-6 text-center">
                <button type="submit" class="bg-amber-800 w-100 px-7 py-2 rounded-full text-white transition-colors hover:bg-amber-700 cursor-pointer">Login</button>
            </div>
        </form>

        <p class="text-end text-xs">
            Belum punya akun? <a href="/sign-up" class="text-indigo-600 underline">Daftar disini!</a>
        </p>
    </div>
</section>

<?= $this->endSection() ?>