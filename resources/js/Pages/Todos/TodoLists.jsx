import React from "react";
import Base from "@/Layouts/Base";
import { Head } from "@inertiajs/inertia-react";

export default function TodoLists({ auth }) {
  return (
    <Base auth={auth}>
      <Head title="Lists" />
    </Base>
  );
}
