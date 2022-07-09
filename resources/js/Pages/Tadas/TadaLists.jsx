import React from "react";
import Base from "@/Layouts/Base";
import Link from "@/Components/Link";
import ValidationErrors from "@/Components/ValidationErrors";
import { Head } from "@inertiajs/inertia-react";

export default function TadaLists({ auth, errors }) {
  return (
    <Base auth={auth}>
      <Head title="Lists" />

      <ValidationErrors errors={errors} />

      <Link method="post" href={route("tadas.store")} as="button">
        New Todo
      </Link>
    </Base>
  );
}
