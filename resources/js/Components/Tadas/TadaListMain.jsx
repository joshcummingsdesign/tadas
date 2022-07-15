/** @jsxImportSource @emotion/react */
import React, { Fragment, useEffect, useRef, useState } from "react";
import AddButton from "@/Components/Buttons/AddButton";
import BareTextInput from "@/Components/Form/BareTextInput";
import Panel from "@/Components/Panel";
import Tada from "@/Components/Tadas/Tada";
import { Inertia } from "@inertiajs/inertia";
import { css } from "@emotion/react";
import { strings } from "@/strings";
import { useTheme, Typography, Stack } from "@mui/material";
import { DragDropContext, Droppable } from "react-beautiful-dnd";

/**
 * TadaListMain component.
 *
 * @since 1.0.0
 */
export default function TadaListMain({ isAddTadaFocused, tadaList, tadas }) {
  const [titleText, setTitleText] = useState("");
  const [isEditingTitle, setIsEditingTitle] = useState(false);
  const [orderedTadas, setOrderedTadas] = useState({});

  const theme = useTheme();
  const addButton = useRef(null);
  const tadaListId = useRef(null);
  const addButtonClicked = useRef(false);

  useEffect(() => {
    const newTadas = tadas.reduce((acc, tada) => {
      acc[`tada-${tada.id}`] = tada;
      return acc;
    }, {});

    setOrderedTadas(newTadas);
  }, [tadas]);

  useEffect(() => {
    if (isAddTadaFocused) {
      addButton.current.focus();
    }
  }, [addButton]);

  useEffect(() => {
    // Set the title text
    setTitleText(tadaList ? tadaList.name : "");

    // Focus title if it is still the default
    if (tadaList && tadaListId.current !== tadaList.id) {
      tadaListId.current = tadaList.id;

      if (tadaList.name === strings.defaultTadaListTitle) {
        setIsEditingTitle(true);
      }
    }
  }, [tadaList, tadaListId]);

  const addTada = () => {
    Inertia.post(
      route("tadas.store"),
      {
        name: strings.defaultTadaTitle,
        tada_list_id: tadaList.id,
      },
      { replace: true }
    );

    addButtonClicked.current = true;
  };

  const handleTitleInputFocus = (e) => {
    e.target.select();
  };

  const handleTitleChange = (e) => {
    setTitleText(e.target.value);
  };

  const handleTitleFocus = () => {
    setIsEditingTitle(true);
  };

  const handleCancel = () => {
    setIsEditingTitle(false);
    setTitleText(tadaList.name);
  };

  const handleTitleUpdate = () => {
    const name = titleText || strings.defaultTadaListTitle;

    setIsEditingTitle(false);
    setTitleText(name);

    Inertia.patch(
      route("tadaLists.update", tadaList.id),
      { name },
      { replace: true }
    );
  };

  const handelKeyDown = (e) => {
    if (e.key === "Enter") {
      handleTitleUpdate();

      // On enter key add a new item if there are none
      // Otherwise, focus the add button
      if (!tadas.length) {
        addTada(tadaList.id);
      } else {
        addButton.current.focus();
      }
    }

    if (e.key === "Escape") {
      handleCancel();
    }
  };

  const handleTadaTitleBlur = () => {
    addButtonClicked.current = false;
  };

  const handleTadaInputEnterKey = () => {
    addTada(tadaList.id);
  };

  const handleDragEnd = ({ source, destination, draggableId }) => {
    if (!destination) {
      return;
    }

    if (
      destination.droppableId === source.droppableId &&
      destination.index === source.index
    ) {
      return;
    }

    // Re-order list
    const tadaIds = Object.keys(orderedTadas);
    tadaIds.splice(source.index, 1);
    tadaIds.splice(destination.index, 0, draggableId);

    const newTadas = tadaIds.reduce((acc, tadaId) => {
      acc[tadaId] = orderedTadas[tadaId];
      return acc;
    }, {});

    setOrderedTadas(newTadas);
  };

  return (
    <Panel>
      <div
        css={css`
          margin: 0 auto;
          max-width: 600px;

          ${theme.breakpoints.up("xl")} {
            width: 50%;
            max-width: 800px;
          }
        `}
      >
        {tadaList && (
          <Fragment>
            {isEditingTitle ? (
              <BareTextInput
                css={css`
                  margin-bottom: 30px;
                `}
                variant="h1"
                autoFocus={true}
                onFocus={handleTitleInputFocus}
                onBlur={handleTitleUpdate}
                onKeyDown={handelKeyDown}
                onChange={handleTitleChange}
                value={titleText}
              />
            ) : (
              <Typography
                variant="h1"
                css={css`
                  margin-bottom: 30px;
                `}
                onClick={handleTitleFocus}
                onFocus={handleTitleFocus}
                tabIndex={0}
              >
                {titleText}
              </Typography>
            )}
            <DragDropContext onDragEnd={handleDragEnd}>
              <Droppable droppableId="tada-list">
                {({ droppableProps, innerRef, placeholder }) => (
                  <div {...droppableProps} ref={innerRef}>
                    <Stack spacing={3}>
                      {Object.keys(orderedTadas).map((tadaId, index) => (
                        <Tada
                          key={tadaId}
                          tada={orderedTadas[tadaId]}
                          index={index}
                          onTadaInputEnterKey={handleTadaInputEnterKey}
                          editOnInit={
                            addButtonClicked.current &&
                            index === tadas.length - 1
                          }
                          onTadaTitleBlur={handleTadaTitleBlur}
                        />
                      ))}
                      {placeholder}
                      <AddButton
                        innerRef={addButton}
                        onClick={addTada}
                        disablePadding={true}
                        autoFocus={true}
                      />
                    </Stack>
                  </div>
                )}
              </Droppable>
            </DragDropContext>
          </Fragment>
        )}
      </div>
    </Panel>
  );
}
