<?php

/**
 * Git hooks configuration
 *
 * Scripts listed here can be found in the `vendor/projektgopher/laravel-git-hooks/scripts` directory.
 * Any single-line terminal command can be used here as well by prepending it was an '@' symbol.
 * @example '@php artisan test'
 * @example '@npm run cypress'
 *
 * After installation, a hook's configuration can be
 * tested by running `git hook run <hook-name>`.
 * @example `git hook run pre-commit`
 */
return [
    // This will have to be changed if you have published the scripts directory
    // `php artisan vendor:publish --tag=laravel-git-hooks-scripts`
    'scripts_dir' => 'vendor/projektgopher/laravel-git-hooks/scripts',

    'disabled' => [
        'pre-push',
    ],

    'hooks' => [
        /**
         * pre-commit
         *
         * This hook is invoked by git-commit, and can be bypassed with the `--no-verify`
         * option. It is invoked before obtaining the proposed commit log message and
         * making a commit. Exiting with a non-zero status from this script causes
         * the git commit command to abort before creating a commit.
         *
         * @see https://git-scm.com/docs/githooks#_pre_commit
         */
        'pre-commit' => [
            'pint-staged',
            'git-add-staged',
            'phpstan-analyse-staged',
        ],

        /**
         * pre-push
         *
         * This hook is invoked by git-push and can be used to prevent a push from taking place.
         * It is called with two parameters which provide the name and location of the destination
         * remote, if a named remote is not being used both values will be the same.
         *
         * If this hook exits with a non-zero status, git push will abort without
         * pushing anything. Information about why the push is rejected may be
         * sent to the user by writing to standard error.
         *
         * @see https://git-scm.com/docs/githooks#_pre_push
         */
        'pre-push' => [
            // 'php-artisan-test',
            '@php artisan test',
        ],
    ],
];
