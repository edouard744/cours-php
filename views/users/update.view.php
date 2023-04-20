<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">
    <div class="min-h-full">
		<?php require base_path('views/partials/nav.view.php');  ?>
		<?php require base_path('views/partials/header.view.php')  ?>
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <form method="post" action="/user">
                    <input type="hidden" name="_method" value="put">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Update a note</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Write something beautiful.</p>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                <div class="col-span-full">
                                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">description</label>

                                    <div class="mt-2">
                                        <label >
                                            Prénom
                                            <input name="firstName" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" value="<?=
                                                $user['firstName'] ?? ''
                                            ?>"></label>


                                        <?php if(isset($errors['firstName'])): ?>

										<p> <?= $errors['firstName'] ?> </p>

										<?php endif; ?>
                                    </div>
                                    <div class="mt-2">
                                        <label >
                                             Nom
                                            <input name="lastName" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" value="<?=
                                                $user['lastName'] ?? ''
                                            ?>"></label>


                                        <?php if(isset($errors['lastName'])): ?>

                                            <p> <?= $errors['lastName'] ?> </p>

                                        <?php endif; ?>
                                    </div>
                                    <div class="mt-2">
                                        <label >
                                            Email
                                            <input name="email" type="email" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" value="<?=
                                                $user['email'] ?? ''
                                            ?>"></label>


                                        <?php if(isset($errors['email'])): ?>

                                            <p> <?= $errors['email'] ?> </p>

                                        <?php endif; ?>
                                    </div>
                                    <div class="mt-2">
                                        <label >
                                            Ancient mots de passe
                                            <input name="oldPassword" type="password" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6">
                                        </label>


                                        <?php if(isset($errors['oldPassword'])): ?>

                                            <p> <?= $errors['oldPassword'] ?> </p>

                                        <?php endif; ?>
                                    </div>
                                    <div class="mt-2">
                                        <label >
                                            Nouveau mots de passe
                                            <input name="newPassword" type="password" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6">
                                        </label>

                                        <?php if(isset($errors['newPassword'])): ?>

                                            <p> <?= $errors['newPassword'] ?> </p>

                                        <?php endif; ?>
                                    </div>

                                    <p class="mt-3 text-sm leading-6 text-gray-600">Update this user.</p>
                                </div>>
                                <input type="hidden" name="update">
                                <input type="hidden" name="id" value="<?= $user['id']?>">
                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="submit" class="rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

</body>

</html>
