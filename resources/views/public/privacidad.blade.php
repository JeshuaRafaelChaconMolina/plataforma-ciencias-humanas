<x-layouts.public :title="'Aviso de Privacidad'">
    <div class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
        <p class="text-xs font-semibold uppercase tracking-widest text-primary-600">Transparencia</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">Aviso de Privacidad</h1>
        <p class="mt-4 text-sm text-slate-500">Última actualización: {{ now()->isoFormat('D [de] MMMM [de] YYYY') }}</p>

        <div class="prose prose-slate mt-10 max-w-none space-y-8 text-sm leading-relaxed text-slate-700">
            <section>
                <h2 class="text-lg font-semibold text-slate-900">¿Qué datos recopilamos?</h2>
                <p class="mt-2">
                    Cuando creas una cuenta o usas este portal, podemos recabar tu nombre, correo electrónico,
                    matrícula y rol (alumno, docente, investigador o administrador). No solicitamos datos
                    sensibles (salud, religión, origen étnico, etc.) en ningún formulario.
                </p>
            </section>

            <section>
                <h2 class="text-lg font-semibold text-slate-900">¿Para qué los usamos?</h2>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    <li>Identificarte y darte acceso al panel que corresponde a tu rol.</li>
                    <li>Permitirte consultar la Biblioteca Virtual, cursos, diplomados y talleres.</li>
                    <li>Comunicarnos contigo sobre tu cuenta o las actividades en las que participas.</li>
                    <li>Mejorar el funcionamiento del portal a partir de estadísticas de uso generales.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-lg font-semibold text-slate-900">¿Cómo protegemos tu información?</h2>
                <p class="mt-2">
                    Tu contraseña se almacena cifrada y nunca es visible, ni siquiera para el equipo
                    administrador. El acceso a los datos de otros usuarios está limitado según tu rol dentro
                    de la plataforma.
                </p>
            </section>

            <section>
                <h2 class="text-lg font-semibold text-slate-900">Tus derechos</h2>
                <p class="mt-2">
                    Puedes solicitar acceder, corregir o eliminar tus datos personales, así como oponerte a
                    algún uso en particular, escribiendo a la persona administradora del portal.
                </p>
            </section>

            <section>
                <h2 class="text-lg font-semibold text-slate-900">Contacto</h2>
                <p class="mt-2">
                    Si tienes dudas sobre este aviso o sobre tus datos, puedes escribir a
                    <a href="mailto:contacto@cienciashumanas.mx" class="font-semibold text-primary-700 hover:underline">contacto@cienciashumanas.unach.mx</a>.
                </p>
            </section>
        </div>
    </div>
</x-layouts.public>