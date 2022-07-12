import React from "react";
import AddButton from "@/Components/AddButton";
import TadaListItem from "@/Components/Tadas/TadaListItem";
import { List } from "@mui/material";
import { Inertia } from "@inertiajs/inertia";

/**
 * TadaListItems component.
 *
 * @unreleased
 */
export default function TadaListItems({ listId, tadaLists }) {
  const addTadaList = () => {
    Inertia.post(
      route("tadaLists.store"),
      {
        name: "Untitled List",
      },
      { replace: true }
    );
  };

  return (
    <List>
      {tadaLists.map((tadaList) => (
        <TadaListItem
          key={tadaList.id}
          tadaList={tadaList}
          selected={tadaList.id === listId}
        />
      ))}
      <AddButton onClick={addTadaList} />
    </List>
  );
}
