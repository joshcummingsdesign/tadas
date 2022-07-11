import React from "react";
import Base from "@/Layouts/Base";
import { Head } from "@inertiajs/inertia-react";

export default function TadaLists({ auth }) {
  return (
    <Base auth={auth}>
      <Head title="Tadas" />
      <h1>Tada Lists</h1>
    </Base>
  );
}
