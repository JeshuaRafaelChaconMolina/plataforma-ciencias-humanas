<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('ver_cursos');
    }

    public function view(User $user, Course $course): bool
    {
        return $user->can('ver_cursos');
    }

    public function create(User $user): bool
    {
        return $user->can('crear_cursos');
    }

    public function update(User $user, Course $course): bool
    {
        return $user->can('editar_cursos');
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->can('eliminar_cursos');
    }
}
