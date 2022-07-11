import React from "react";
import AddButton from "@/Components/AddButton";
import TadaListItem from "@/Components/Tadas/TadaListItem";
import { List } from "@mui/material";

export default function TadaListItems({ items }) {
  return (
    <List>
      {items.map((v, i) => (
        <TadaListItem key={i} selected={true} />
      ))}
      <AddButton />
    </List>
  );
}
