/** @jsxImportSource @emotion/react */
import React, { Fragment, useEffect, useRef, useState } from "react";
import AddButton from "@/Components/AddButton";
import BareTextInput from "@/Components/Form/BareTextInput";
import Tada from "@/Components/Tadas/Tada";
import { Inertia } from "@inertiajs/inertia";
import { css } from "@emotion/react";
import { useTheme, Typography, Stack } from "@mui/material";
import { strings } from "@/strings";

/**
 * TadaListMain component.
 *
 * @since 1.0.0
 */
export default function TadaListMain({ isAddTadaFocused, tadaList, tadas }) {
  const [titleText, setTitleText] = useState("");
  const [isEditingTitle, setIsEditingTitle] = useState(false);

  const theme = useTheme();
  const addButton = useRef(null);
  const tadaListId = useRef(null);
  const addButtonClicked = useRef(false);

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

  return (
    <section
      css={css`
        height: calc(100vh - 56px);
        width: 100%;
        overflow-y: auto;
        background-color: ${theme.palette.mode === "light"
          ? "rgba(0,0,0,0.03)"
          : "rgba(255,255,255,0.03)"};

        ${theme.breakpoints.up("sm")} {
          height: calc(100vh - 64px);
        }

        ${theme.breakpoints.up("md")} {
          width: calc(100% - 300px);
        }
      `}
    >
      <div
        css={css`
          padding: 30px;
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
            <Stack spacing={3}>
              {tadas.map((tada, i) => (
                <Tada
                  key={tada.id}
                  tada={tada}
                  onTadaInputEnterKey={handleTadaInputEnterKey}
                  editOnInit={
                    addButtonClicked.current && i === tadas.length - 1
                  }
                  onTadaTitleBlur={handleTadaTitleBlur}
                />
              ))}
              <AddButton
                innerRef={addButton}
                onClick={addTada}
                disablePadding={true}
                autoFocus={true}
              />
            </Stack>
          </Fragment>
        )}
      </div>
    </section>
  );
}
