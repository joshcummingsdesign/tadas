import React, { useRef, useEffect } from "react";
import AddButton from "@/Components/AddButton";
import TadaListItem from "@/Components/Tadas/TadaListItem";
import { Inertia } from "@inertiajs/inertia";
import { List } from "@mui/material";
import { strings } from "@/strings";

/**
 * TadaListItems component.
 *
 * @since 1.0.0
 */
export default function TadaListItems({
  isAddTadaListFocused,
  listId,
  tadaLists,
}) {
  const addButton = useRef(null);

  useEffect(() => {
    if (isAddTadaListFocused) {
      addButton.current.focus();
    }
  }, [addButton, tadaLists]);

  const addTadaList = () => {
    Inertia.post(
      route("tadaLists.store"),
      {
        name: strings.defaultTadaListTitle,
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
      <AddButton innerRef={addButton} onClick={addTadaList} />
    </List>
  );
}
